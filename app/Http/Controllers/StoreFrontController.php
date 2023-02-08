<?php

namespace App\Http\Controllers;

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

class StoreFrontController extends Controller
{
    public function storeFront(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();
        $products = StoreProduct::latest()->where('store_id', $store->id)->get();
        return view('dashboard.mystoree', compact('store', 'products'));
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
        $store = Store::where('name', $request->storename)->first();
        $cart = session()->get('cart');
        //dd($cart);
        $totalAmount = 0;
        $qty = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $qty += $item['quantity'];
        }
        //dd($request->name, $request->email, $request->phoneNo, $request->address, $request->state, $request->country);

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
        session()->forget('cart');

        $data = [
            'store' => $store,
            'order' => $order
        ];
        $pdf = PDF::loadView('myPDF', $data);
        return view('myPDF', compact('store', 'order'));
        //return redirect()->back()->with('success', 'Order Completed!');

        //dd($request, $cart, $totalAmount, $store->id);

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
