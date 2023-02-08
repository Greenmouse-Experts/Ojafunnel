<?php

namespace App\Http\Controllers;

use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;
use Auth;


class StoreController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:stores|max:255',
                'description' => 'required',
                'link' => 'required',
                'theme' => 'required'
            ],
            [
                'name.unique' => 'Store name has already been taken, please use another one!',
            ]
        );

        if ($request->file('logo')) {
            $image = $request->file('logo')->store(
                'uploads/storeLogo/' . \Auth::user()->username,
                'public'
            );
        }
        $store = new Store();
        $store->name = $request->name;
        $store->description = $request->description;
        $store->link = $request->link;
        $store->logo = $image;
        $store->theme = $request->theme;
        $store->color = '#fff';
        $store->user_id = \Auth::user()->id;
        $store->save();

        return back()->with([
            'type' => 'success',
            'message' => $request->name . ' store created successfully'
        ]);
    }

    public function updateStore(Request $request)
    {
        $store = Store::findOrFail($request->id);
        $store->name = $request->name;
        $store->description = $request->description;
        $store->link = $request->link;
        if ($request->file('logo')) {
            $image = $request->file('logo')->store(
                'uploads/storeLogo/' . Auth::user()->username,
                'public'
            );
            $store->logo = $image;
        }
        $store->theme = $request->theme;
        $store->color = '#fff';
        $store->user_id = Auth::user()->id;
        $store->update();

        return back()->with([
            'type' => 'success',
            'message' => $request->name . ' store updated successfully'
        ]);
    }

    public function deleteStore(Request $request)
    {
        StoreProduct::where('store_id', $request->id)->delete();
        $store = Store::findOrFail($request->id);
        $store->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Store deleted successfully'
        ]);
    }

    public function shops($username)
    {
        $store = Store::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.Shops', compact('username', 'store'));
    }

    public function viewstore($username)
    {
        $store = Store::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.checkstore', compact('username', 'store'));
    }

    public function storeFront(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();
        $products = StoreProduct::latest()->where('store_id', $store->id)->get();
        return view('dashboard.mystoree', compact('store', 'products'));
    }

    public function available_product(Request $request, $username)
    {
        $product = StoreProduct::latest()->where('store_id', $request->store_id)->get();
        $store_id = $request->store_id;
        return view('dashboard.AvailableProduct', compact('product', 'store_id', 'username'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'quantity' => 'required'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store(
                'uploads/storeProduct/' . Auth::user()->username,
                'public'
            );
        }

        $sp = new StoreProduct();
        $sp->name = $request->name;
        $sp->description = $request->description;
        $sp->price = $request->price;
        $sp->quantity = $request->quantity;
        $sp->image = $image;
        $sp->store_id = $request->store_id;
        $sp->save();

        return back()->with([
            'type' => 'success',
            'message' => $request->name . ' added to store product successfully'
        ]);
    }

    public function updateProduct(Request $request)
    {
        $sp = StoreProduct::findOrFail($request->id);
        $sp->name = $request->name;
        $sp->description = $request->description;
        $sp->price = $request->price;
        $sp->quantity = $request->quantity;
        if ($request->file('image')) {
            $image = $request->file('image')->store(
                'uploads/storeProduct/' . Auth::user()->username,
                'public'
            );
            $sp->image = $image;
        }
        $sp->store_id = $request->store_id;
        $sp->update();

        return back()->with([
            'type' => 'success',
            'message' => $sp->name . ' update successfully'
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $sp = StoreProduct::findOrFail($request->id);

        $sp->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Product deleted successfully'
        ]);
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
        dd($request);
    }
}
