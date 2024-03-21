<?php

namespace App\Http\Controllers;

use App\Mail\StoreFrontMail;
use App\Models\OjafunnelNotification;
use App\Models\OrderItem;
use App\Models\OrderUser;
use App\Models\PaymentGateway;
use App\Models\Promotion;
use App\Models\Store;
use App\Models\StoreCoupon;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPaymentGateway;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Exception;
use Stripe;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;
use Stevebauman\Location\Facades\Location;

class StoreFrontController extends Controller
{
    private $gateway;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Fetch PaymentGateway details from the database
        $paymentGateway = PaymentGateway::where('name', 'Paypal')->first();

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($paymentGateway->PAYPAL_CLIENT_ID);
        $this->gateway->setSecret($paymentGateway->PAYPAL_CLIENT_SECRET);
        if($paymentGateway->PAYPAL_MODE == 'sandbox')
        {
            $this->gateway->setTestMode(true);
        } else {
            $this->gateway->setTestMode(false);
        }
    }

    public function storeFront(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();

        $products = [];

        if(!isset($request->search_string)) {
            $products = StoreProduct::latest()->where('store_id', $store->id)->where('quantity', '>', 0)->get();
        } else {
            $needle = $request['search_string'];
            $products = StoreProduct::where('store_id', $store->id)->where('quantity', '>', 0)
                ->where('name', 'like', "%$needle%")
                ->get();
        }

        $isvalid = false;

        // "timeRemaining" => $timeRemaining,

        // $product = StoreProduct::findOrFail($id);

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
        // Get user's IP address
        // $ip = $request->ip();

        // Get location data based on IP
        // $location = Location::get($ip);

        // return $location;
        $store = Store::latest()->where('name', $request->storename)->first();
        $products = StoreProduct::latest()->where('store_id', $store->id)->get();
        $paymentGateway = UserPaymentGateway::where(['user_id' => $store->user_id, 'name' => $store->payment_gateway])->first();

        return view('dashboard.store.checkout', compact('store', 'products', 'paymentGateway'));
    }

    public function addToCart($id, $storename)
    {
        $product = StoreProduct::findOrFail($id);
        $store = Store::latest()->where('name', $storename)->first();
        $targetDate = strtotime($product->date_to);
        $now = time();
        $timeRemaining = $targetDate - $now;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                'rmQuan' => $product->quantity,
                "price" => $timeRemaining > 0 ? $product->new_price : $product->price,
                "currency" => $store->currency,
                "currency_sign" => $store->currency_sign,
                "description" => $product->description,
                "image" => $product->image,
                "timeRemaining" => $timeRemaining,
                'store' => $store
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
            $customer_email = session()->get('customer_email');
            if (isset($cart[$request->id])) {

                $product_id = $cart[$request->id];
                \App\Models\TempCart::where('email', $customer_email)->where('product_id', $product_id)->delete();
                session()->forget('customer_email');

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
        /* return $promotion_id && $product_id
            ? $this->checkoutPaymentWithPromotion($request, $promotion_id, $product_id)
            : $this->checkoutPaymentWithoutPromotion($request, $product_id); */

        return $this->checkoutPaymentWithPromotion($request, $promotion_id, $product_id);
    }

    protected function checkoutPaymentWithPromotion(Request $request, $promotion_id, $product_id)
    {
        $store = Store::where('name', $request->storename)->first();

        if($request->paymentOptions == 'Stripe')
        {
            // Fetch PaymentGateway details from the database
            $paymentGateway = PaymentGateway::where('name', 'Stripe')->first();

            try {
                $stripe = new StripeClient($paymentGateway->STRIPE_SECRET);

                $stripe->paymentIntents->create([
                    'amount' => $request->amountToPay * 100,
                    'currency' => $store->currency,
                    'payment_method' => $request->payment_method,
                    'description' => 'Product payment with stripe',
                    'confirm' => true,
                    'receipt_email' => $request->email,
                    'automatic_payment_methods[enabled]' => true,
                    'automatic_payment_methods[allow_redirects]' => 'never'
                ]);
            } catch (CardException $th) {
                return back()->with([
                    'type' => 'danger',
                    'message' => "There was a problem processing your payment."
                ]);
            }
        }

        $cart = session()->get('cart');

        $promoter = User::where(['promotion_link' => $promotion_id]);

        $totalAmount = 0;
        $qty = 0;

        foreach ($cart as $item) {
            // Check if the item belongs to the specified store
            if (isset($item['store']) && $item['store']->name == $store->name) {
                $item_price = $item['price'] * $item['quantity'];
                $totalAmount += $item_price;

                $qty += $item['quantity'];
            }
        }

        // order
        $order = new StoreOrder();
        $order->store_id = $store->id;
        $order->order_no = Str::random(6);
        $order->payment_method = $request->paymentOptions;
        $order->quantity = $qty;
        $order->coupon = json_encode([
            'coupon_id' => $request->couponID,
            'percent' => StoreCoupon::find($request->couponID)->discount_percent ?? null,
            'amountPaid' => $store->currency_sign.''.$request->amountToPay,
        ]);
        $order->amount = $store->currency_sign.''.$totalAmount;
        $order->save();

        foreach ($cart as $item) {
            if (isset($item['store']) && $item['store']->name == $store->name) {
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
                    $level1_fee = ($product->level1_comm / 100) * $item_price;

                    if ($promoter->first()->referral_link != null || $promoter->first()->referral_link != "") {
                        // promoter's refer by free
                        $level2_fee = ($product->level2_comm / 100) * $item_price;
                    }

                    $item_amount = $item_price - ($level1_fee + $level2_fee);
                } else {
                    $item_amount = $item_price;
                }

                // order item
                $orderItem = new OrderItem();
                $orderItem->store_order_id = $order->id;
                $orderItem->store_product_id = $item['id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->amount = $store->currency_sign.''.$item['price'];
                $orderItem->type = $item['id'] == $product_id && $promoter->exists() ? 'Promotion' : 'Normal';
                $orderItem->save();

                // update store_product quantity
                $store_product = StoreProduct::findOrFail($item['id']);
                $store_product->quantity = $store_product->quantity - $item['quantity'];
                $store_product->update();

                // add fund to vendor wallet
                $userData = User::findOrFail($store->user_id);
                // if($store->currency == 'NGN')
                // {
                //     $userData->wallet = $userData->wallet + $item_amount;
                // } else {
                //     $userData->dollar_wallet = $userData->dollar_wallet + $item_amount;
                // }
                // $userData->update();

                // VENDOR
                // add record to transaction table for vendor - (plus)
                $trans = new Transaction();
                $trans->user_id = $store->user_id;
                $trans->amount = $store->currency_sign.''.$item_price;
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
                Mail::to($vendor->email)->send(new StoreFrontMail('Store Product Purchase', "Hello $vendor->username, a new product has been purchased in your store with a total amount of $store->currency_sign $item_price"));

                // add fund to promoter and promoter referral wallet
                if ($item['id'] == $product_id && $promoter->exists()) {
                    if($store->currency == 'NGN')
                    {
                        // level1 fee
                        $promoter->update([
                            'promotion_bonus' => $promoter->first()->promotion_bonus + $level1_fee
                        ]);
                    } else {
                        // level1 fee
                        $promoter->update([
                            'dollar_promotion_bonus' => $promoter->first()->dollar_promotion_bonus + $level1_fee
                        ]);
                    }

                    // LEVEL 1
                    // add record to transaction table for vendor - (minus)
                    $trans = new Transaction();
                    $trans->user_id = $store->user_id;
                    $trans->amount = $store->currency_sign."-$level1_fee";
                    $trans->reference = Str::random(8);
                    $trans->status = 'Level 1 Fee Deduction';
                    $trans->save();


                    // add record to transaction table for promoter - (plus)
                    $trans = new Transaction();
                    $trans->user_id = $promoter->first()->id;
                    $trans->amount = $store->currency_sign."$level1_fee";
                    $trans->reference = Str::random(8);
                    $trans->status = 'Level 1 Fee Received';
                    $trans->save();

                    Promotion::create([
                        'promoter_id' =>  $promoter->first()->id,
                        'order_item_id' => $orderItem->id,
                        'store_owner_id' => $store->user_id,
                        'store_id' => $store->id,
                        'transaction_id' => $trans->id,
                        'amount' => $level1_fee,
                        'type' => 'Product'
                    ]);

                    OjafunnelNotification::create([
                        'to' => $promoter->first()->id,
                        'title' => config('app.name'),
                        'body' => 'You have received level 1 fee of ' . $store->currency_sign.''.$level1_fee . ' for promoting ' . $item['name'] . '.'
                    ]);

                    // send mail to both vendor and promoter - for level 1
                    Mail::to($vendor->email)->send(new StoreFrontMail('Level 1 Fee Deduction', "Hello $vendor->username, a total amount of $store->currency_sign $level1_fee has been deducted from your account for level 1 commission."));
                    Mail::to($promoter->first()->email)->send(new StoreFrontMail('Level 1 Fee Received', "Hello " . $promoter->first()->username . ", a total amount of $store->currency_sign $level1_fee has been added to your account for level 1 commission."));

                    // level2 fee
                    if ($promoter->first()->referral_link != null || $promoter->first()->referral_link != "") {
                        $user = User::where(['id' => $promoter->first()->referral_link]);

                        if($store->currency == 'NGN')
                        {
                            $user->update([
                                'promotion_bonus' => $user->first()->promotion_bonus + $level2_fee
                            ]);
                        } else {
                            $user->update([
                                'dollar_promotion_bonus' => $user->first()->dollar_promotion_bonus + $level2_fee
                            ]);
                        }

                        // LEVEL 2
                        // add record to transaction table for vendor - (minus)
                        $trans = new Transaction();
                        $trans->user_id = $store->user_id;
                        $trans->amount = $store->currency_sign."-$level2_fee";
                        $trans->reference = Str::random(8);
                        $trans->status = 'Level 2 Fee Deducted';
                        $trans->save();

                        // add record to transaction table for promoter referral - (plus)
                        $trans = new Transaction();
                        $trans->user_id = $user->first()->id;
                        $trans->amount = $store->currency_sign."$level2_fee";
                        $trans->reference = Str::random(8);
                        $trans->status = 'Level 2 Fee Received';
                        $trans->save();

                        Promotion::create([
                            'promoter_id' =>  $user->first()->id,
                            'order_item_id' => $orderItem->id,
                            'store_owner_id' => $store->user_id,
                            'store_id' => $store->id,
                            'transaction_id' => $trans->id,
                            'amount' => $level2_fee,
                            'type' => 'Product'
                        ]);


                        OjafunnelNotification::create([
                            'to' => $user->first()->id,
                            'title' => config('app.name'),
                            'body' => 'You have received level 2 fee of ' . $store->currency_sign.''.$level2_fee . ' for referring the promoter of ' . $item['name'] . '.'
                        ]);

                        // send mail to both vendor and promoter referral - for level 2
                        Mail::to($vendor->email)->send(new StoreFrontMail('Level 2 Fee Deduction', "Hello $vendor->username, a total amount of $store->currency_sign $level2_fee has been deducted from your account for level 2 commission."));
                        Mail::to($user->first()->email)->send(new StoreFrontMail('Level 2 Fee Received', "Hello " . $user->first()->username . ", a total amount of $store->currency_sign $level2_fee has been added to your account for referring the promoter (i.e level 2 commission)."));
                    }
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

        // delete my details since i have made payment
        \App\Models\TempCart::where('email', $request->email)->where('product_id', $product_id)->delete();

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
    }

    protected function checkoutPaymentWithoutPromotion(Request $request, $product_id)
    {
        $store = Store::where('name', $request->storename)->first();

        if($request->paymentOptions == 'Paypal')
        {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phoneNo,
                'address' => $request->address,
                'state' => $request->state,
                'country' => $request->country,
                'cart' => session()->get('cart'),
                'storename' => $request->storename,
                'storename' => $request->amountToPay,
                'couponID' => $request->couponID
            ];

            // Fetch PaymentGateway details from the database
            $paymentGateway = PaymentGateway::where('name', 'Paypal')->first();

            // try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->amountToPay,
                    'description' => $data,
                    'currency' => $paymentGateway->PAYPAL_CURRENCY,
                    'returnUrl' => route('success.payment'),
                    'cancelUrl' => route('cancel.payment')
                ))->send();

                return  $response->redirect();

                if ($response->isRedirect()) {
                    $response->redirect();
                }
                else {
                    return back()->with(
                        'danger',
                        $response->getMessage()
                    );
                }
            // } catch (\Throwable $th) {
            //     return back()->with(
            //         'danger',
            //         $th->getMessage()
            //     );
            // }

        }

        if($request->paymentOptions == 'Stripe')
        {
            // Fetch PaymentGateway details from the database
            $paymentGateway = PaymentGateway::where('name', 'Stripe')->first();

            try {
                $stripe = new StripeClient($paymentGateway->STRIPE_SECRET);

                $stripe->paymentIntents->create([
                    'amount' => $request->amountToPay * 100,
                    'currency' => $store->currency,
                    'payment_method' => $request->payment_method,
                    'description' => 'Product payment with stripe',
                    'confirm' => true,
                    'receipt_email' => $request->email,
                    'automatic_payment_methods[enabled]' => true,
                    'automatic_payment_methods[allow_redirects]' => 'never'
                ]);
            } catch (CardException $th) {
                return back()->with([
                    'type' => 'danger',
                    'message' => "There was a problem processing your payment."
                ]);
            }
        }

        $cart = session()->get('cart');

        $totalAmount = 0;
        $qty = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $qty += $item['quantity'];
        }

        $order = new StoreOrder();
        $order->store_id = $store->id;
        $order->order_no = Str::random(6);
        $order->payment_method = $request->paymentOptions;
        $order->quantity = $qty;
        $order->coupon = json_encode([
            'coupon_id' => $request->couponID,
            'percent' => StoreCoupon::find($request->couponID)->discount_percent ?? null,
            'amountPaid' => $request->amountToPay,
        ]);
        $order->amount = $store->currency_sign.''.$totalAmount;
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
            $orderItem->amount = $store->currency_sign.''.$item['price'];
            $orderItem->type = 'Normal';
            $orderItem->save();

            $ss = StoreProduct::findOrFail($item['id']);
            $ss->quantity = $ss->quantity - $item['quantity'];
            $ss->update();
        }

        $userData = User::findOrFail($store->user_id);
        if($store->currency == 'NGN')
        {
            $userData->wallet = $userData->wallet + $request->amountToPay;
        } else {
            $userData->dollar_wallet = $userData->dollar_wallet + $request->amountToPay;
        }
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
        $trans->amount =  $store->currency_sign.''.$request->amountToPay;
        $trans->reference = Str::random(8);
        $trans->status = 'Product Purchase';
        $trans->save();

        OjafunnelNotification::create([
            'to' => $store->user_id,
            'title' => config('app.name'),
            'body' => $request->name . ' purchase product in your shop.'
        ]);

        // delete my details since i have made payment
        \App\Models\TempCart::where('email', $request->email)->where('product_id', $product_id)->delete();

        session()->forget('cart');

        /** Store information to include in mail in $data as an array */
        $data = array(
            'store' => $store,
            'order' => $order,
            'email' => $user->email
        );

        /** Send message to the user */
        Mail::send('emails.receiptEM', $data, function ($m) use ($data) {
            // Set the subject line to include the store name and order ID
            $m->to($data['email'])->subject('Receipt for Order: ' . $data['order']->order_no . ' from ' . $data['store']->name);
        });

        $data = [
            'store' => $store,
            'order' => $order
        ];
        $pdf = PDF::loadView('myPDF', $data);

        return view('myPDF', compact('store', 'order'));
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

    public function checkCoupon(Request $request)
    {
        $coupon = StoreCoupon::where('coupon_code', $request->coupon)->where('start_date', '<=', Carbon::today()->toDateString())
        ->where('end_date', '>=', Carbon::today()->toDateString())->first();

        if($coupon)
        {
            $discount_price = ($request->totalAmount / 100) * $coupon->discount_percent;

            // return ($discount_price);
            return response()->json([
                'success' => true,
                'message' => 'Discount initiated, place your order',
                'data' => $discount_price,
                'id' => $coupon->id
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Coupon code doesn't exist or it has expired.",
        ]);
    }

    public function retrievePayment($name)
    {
        // Fetch PaymentGateway details from the database
        $paymentGateway = PaymentGateway::where('name', $name)->first();

        // You can return a view or JSON response based on your needs
        return response()->json($paymentGateway);
    }

    public function paymentSuccess(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if ($response->isSuccessful()) {

                $arr = $response->getData();

                return $arr;

                // $training = Training::find($arr['transactions'][0]['description']);

                // $training->update([
                //     'status' => 'Paid'
                // ]);

                return back()->with(
                    'success',
                    'Thank you, Your training application has been successfully submitted.'
                );
            }
            else{
                return back()->with(
                    'danger',
                    $response->getMessage()
                );
            }
        }
        else{
            return back()->with(
                'danger',
                'Payment declined!!'
            );
        }
    }

    public function paymentCancel()
    {
        return back()->with(
            'danger',
            'User declined the payment!'
        );
    }
}
