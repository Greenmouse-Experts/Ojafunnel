<?php

namespace App\Http\Controllers;

use App\Mail\StoreFrontMail;
use App\Models\OjafunnelNotification;
use App\Models\OrderItem;
use App\Models\OrderUser;
use App\Models\Store;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class StoreFrontController extends Controller
{
    public function storeFront(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();
        $products = StoreProduct::latest()->where('store_id', $store->id)->where('quantity', '>', 0)->get();

        $isvalid = false;

        if ($request->has('promotion_id')) {
            $user = User::where('promotion_link', $request->promotion_id);

            // if user exist then promotion code is valid
            if ($user->exists()) {
                $isvalid = true;

                return view('dashboard.mystoree', compact('store', 'products', 'isvalid'));
            } else return view('dashboard.mystoree', compact('store', 'products', 'isvalid'));
            //
        } else return view('dashboard.mystoree', compact('store', 'products', 'isvalid'));
    }

    public function cart(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();
        $products = StoreProduct::latest()->where('store_id', $store->id)->get();

        return view('dashboard.store.cart', compact('store', 'products'));
    }

    public function checkout(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();
        $products = StoreProduct::latest()->where('store_id', $store->id)->get();
        return view('dashboard.store.checkout', compact('store', 'products'));
    }

    public function addToCart($id)
    {
        $product = StoreProduct::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                'rmQuan' => $product->quantity,
                "price" => $product->price,
                "description" => $product->description,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $product = StoreProduct::findOrFail($request->id);

        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkoutPayment(Request $request)
    {
        $promotion_id = $request->has('promotion_id') ? $request->get('promotion_id') : null;
        $product_id = $request->has('product_id') ? $request->get('product_id') : null;

        // is there any promotion link?
        return $promotion_id && $product_id
            ? $this->checkoutPaymentWithPromotion($request, $promotion_id, $product_id)
            : $this->checkoutPaymentWithoutPromotion($request);
    }

    protected function checkoutPaymentWithPromotion(Request $request, $promotion_id, $product_id)
    {
        $store = Store::where('name', $request->storename)->first();
        $cart = session()->get('cart');

        $promoter = User::where(['promotion_link' => $promotion_id]);

        $totalAmount = 0;
        $qty = 0;

        foreach ($cart as $item) {
            $item_price = $item['price'] * $item['quantity'];
            $totalAmount += $item_price;

            $qty += $item['quantity'];
        }

        // order
        $order = new StoreOrder();
        $order->store_id = $store->id;
        $order->order_no = Str::random(6);
        $order->payment_method = 'Paystack';
        $order->quantity = $qty;
        $order->amount = $totalAmount;
        $order->save();

        foreach ($cart as $item) {
            // item price
            $item_price = $item['price'] * $item['quantity'];

            // item total amount
            $item_amount = 0;
            // promoter
            $level1_fee = 0;
            // promoter's refer by
            $level2_fee = 0;
            //

            if ($item['id'] == $product_id && $promoter->exists()) {
                $product = StoreProduct::find($item['id'])->first();

                // promoter fee
                $level1_fee = $product->level1_comm / 100 * $item_price;

                if ($promoter->first()->referral_link != null) {
                    // promoter's refer by free
                    $level2_fee = $product->level2_comm / 100 * $item_price;
                }

                $item_amount = $item_price - ($level1_fee + $level2_fee);
            } else $item_amount = $item_price;

            // order item
            $orderItem = new OrderItem();
            $orderItem->store_order_id = $order->id;
            $orderItem->store_product_id = $item['id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->amount = $item['price'];
            $orderItem->type = $item['id'] == $product_id && $promoter->exists() ? 'Promotion' : 'Normal';
            $orderItem->save();

            // update store_product quantity
            $store_product = StoreProduct::findOrFail($item['id']);
            $store_product->quantity = $store_product->quantity - $item['quantity'];
            $store_product->update();

            // add fund to vendor wallet
            $userData = User::findOrFail($store->user_id);
            $userData->wallet = $userData->wallet + $item_amount;
            $userData->update();

            // VENDOR
            // add record to transaction table for vendor - (plus)
            $trans = new Transaction();
            $trans->user_id = $store->user_id;
            $trans->amount = $item_price;
            $trans->reference = Str::random(8);
            $trans->status = 'Product Purchase';
            $trans->save();
            OjafunnelNotification::create([
                'to' => $store->user_id,
                'title' => config('app.name'),
                'body' => $request->name . ' purchase product in your shop.'
            ]);

            // send mail to vendor
            $vendor = User::where('id', $store->user_id)->first();
            Mail::to($vendor->email)->send(new StoreFrontMail('Store Product Purchase', "Hello $vendor->username, a new product has been purchased in your store with a total amount of $item_price"));

            // add fund to promoter and promoter referral wallet
            if ($item['id'] == $product_id && $promoter->exists()) {
                // level1 fee 
                $promoter->update([
                    'wallet' => $promoter->first()->wallet + $level1_fee,
                    'promotion_bonus' => $promoter->first()->promotion_bonus + $level1_fee
                ]);

                // LEVEL 1
                // add record to transaction table for vendor - (minus)
                $trans = new Transaction();
                $trans->user_id = $store->user_id;
                $trans->amount = "-$level1_fee";
                $trans->reference = Str::random(8);
                $trans->status = 'Level 1 Fee Deduction';
                $trans->save();

                // add record to transaction table for promoter - (plus)
                $trans = new Transaction();
                $trans->user_id = $promoter->first()->id;
                $trans->amount = "$level1_fee";
                $trans->reference = Str::random(8);
                $trans->status = 'Level 1 Fee Received';
                $trans->save();
                OjafunnelNotification::create([
                    'to' => $promoter->first()->id,
                    'title' => config('app.name'),
                    'body' => 'You have received level 1 fee of ' . $level1_fee . ' for promoting ' . $item['name'] . '.'
                ]);

                // send mail to both vendor and promoter - for level 1
                Mail::to($vendor->email)->send(new StoreFrontMail('Level 1 Fee Deduction', "Hello $vendor->username, a total amount of $level1_fee has been deducted from your account for level 1 commission."));
                Mail::to($promoter->first()->email)->send(new StoreFrontMail('Level 1 Fee Received', "Hello " . $promoter->first()->username . ", a total amount of $level1_fee has been added to your account for level 1 commission."));

                // level2 fee
                if ($promoter->first()->referral_link != null) {
                    $user = User::where(['id' => $promoter->first()->referral_link]);

                    $user->update([
                        'wallet' => $user->first()->wallet + $level2_fee,
                        'promotion_bonus' => $user->first()->promotion_bonus + $level2_fee
                    ]);

                    // LEVEL 2
                    // add record to transaction table for vendor - (minus)
                    $trans = new Transaction();
                    $trans->user_id = $store->user_id;
                    $trans->amount = "-$level2_fee";
                    $trans->reference = Str::random(8);
                    $trans->status = 'Level 2 Fee Deducted';
                    $trans->save();

                    // add record to transaction table for promoter referral - (plus)
                    $trans = new Transaction();
                    $trans->user_id = $user->first()->id;
                    $trans->amount = "$level2_fee";
                    $trans->reference = Str::random(8);
                    $trans->status = 'Level 2 Fee Received';
                    $trans->save();
                    OjafunnelNotification::create([
                        'to' => $user->first()->id,
                        'title' => config('app.name'),
                        'body' => 'You have received level 2 fee of ' . $level2_fee . ' for referring the promoter of ' . $item['name'] . '.'
                    ]);

                    // send mail to both vendor and promoter referral - for level 2
                    Mail::to($vendor->email)->send(new StoreFrontMail('Level 2 Fee Deduction', "Hello $vendor->username, a total amount of $level2_fee has been deducted from your account for level 2 commission."));
                    Mail::to($user->first()->email)->send(new StoreFrontMail('Level 2 Fee Received', "Hello " . $user->first()->username . ", a total amount of $level2_fee has been added to your account for referring the promoter (i.e level 2 commission)."));
                }
            }
        }

        // 
        $user = new OrderUser();
        $user->store_order_id = $order->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phoneNo;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->save();

        // $trans = new Transaction();
        // $trans->user_id = $store->user_id;
        // $trans->amount = $totalAmount;
        // $trans->reference = Str::random(8);
        // $trans->status = 'Product Purchase';
        // $trans->save();

        // OjafunnelNotification::create([
        //     'to' => $store->user_id,
        //     'title' => config('app.name'),
        //     'body' => $request->name.' purchase product in your shop.'
        // ]);

        session()->forget('cart');

        /** Store information to include in mail in $data as an array */
        $data = array(
            'store' => $store,
            'order' => $order,
            'email' => $user->email
        );

        /** Send message to the user */
        Mail::send('emails.receiptEM', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        // Send email to user
        // $user->notify(new SendCodeResetPassword($codeData->code)

        $data = [
            'store' => $store,
            'order' => $order
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return view('myPDF', compact('store', 'order'));
    }

    protected function checkoutPaymentWithoutPromotion(Request $request)
    {
        $store = Store::where('name', $request->storename)->first();
        $cart = session()->get('cart');

        $totalAmount = 0;
        $qty = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $qty += $item['quantity'];  
        }

        // dd($request->name, $request->email, $request->phoneNo, $request->address, $request->state, $request->country);

        $order = new StoreOrder();
        $order->store_id = $store->id;
        $order->order_no = Str::random(6);
        $order->payment_method = 'Paystack';
        $order->quantity = $qty;
        $order->amount = $totalAmount;
        $order->save();

        $data = [];

        foreach ($cart as $item) {
            $data['items'] = [
                [
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'desc' => $item['name'],
                    'qty' => $item['quantity'],
                ]
            ];

            $orderItem = new OrderItem();
            $orderItem->store_order_id = $order->id;
            $orderItem->store_product_id = $item['id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->amount = $item['price'];
            $orderItem->type = 'Normal';
            $orderItem->save();

            $ss = StoreProduct::findOrFail($item['id']);
            $ss->quantity = $ss->quantity - $item['quantity'];
            $ss->update();
        }

        $userData = User::findOrFail($store->user_id);

        $userData->wallet = $userData->wallet + $totalAmount;
        $userData->update();

        $user = new OrderUser();
        $user->store_order_id = $order->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phoneNo;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->save();

        $trans = new Transaction();
        $trans->user_id = $store->user_id;
        $trans->amount = $totalAmount;
        $trans->reference = Str::random(8);
        $trans->status = 'Product Purchase';
        $trans->save();

        OjafunnelNotification::create([
            'to' => $store->user_id,
            'title' => config('app.name'),
            'body' => $request->name . ' purchase product in your shop.'
        ]);

        session()->forget('cart');

        /** Store information to include in mail in $data as an array */
        $data = array(
            'store' => $store,
            'order' => $order,
            'email' => $user->email
        );

        /** Send message to the user */
        Mail::send('emails.receiptEM', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        $data = [
            'store' => $store,
            'order' => $order
        ];
        $pdf = PDF::loadView('myPDF', $data);

        return view('myPDF', compact('store', 'order'));
        //return redirect()->back()->with('success', 'Order Completed!');
    }

    public function Pdf()
    {
        $order = StoreOrder::where('id', 3)->first();
        $store = Store::where('name', 'GreenMouse1')->first();
        $data = [
            'store' => $store,
            'order' => $order
        ];
        $pdf = PDF::loadView('myPDF', $data);
        return view('myPDF', compact('store', 'order'));
        //dd($store);

        //return $pdf->download('invoice.pdf');
    }
}
