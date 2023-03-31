<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\OrderUser;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;
use Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;



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

    public function available_product(Request $request, $username)
    {
        $product = StoreProduct::latest()->where('store_id', $request->store_id)->get();
        $store_id = $request->store_id;

        return view('dashboard.AvailableProduct', compact('product', 'store_id', 'username'));
    }

    public function sales(Request $request, $username)
    {
        $order = StoreOrder::latest()->where('store_id', $request->store_id)->get();
        $store = Store::findOrFail($request->store_id);
        return view('dashboard.sales', [
            'username' => $username,
            'order' => $order,
            'store' => $store,
        ]);
    }

    public function order_details(Request $request, $username)
    {
        $order = StoreOrder::latest()->where('id', $request->id)->first();
        //dd($order->store_id);
        $store = Store::where('id', $order->store_id)->first();

        return view('dashboard.OrderDetails', [
            'username' => $username,
            'order' => $order,
            'store' => $store,
        ]);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'quantity' => 'required',
            'level1_comm' => 'required',
            'level2_comm' => 'required',
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
        $sp->level1_comm = $request->level1_comm;
        $sp->level2_comm = $request->level2_comm;
        $sp->image = $image;
        $sp->store_id = $request->store_id;

        // check if level1_comm <= level2_comm... then fail
        if ($request->level1_comm <= $request->level2_comm) return back()->with([
            'type' => 'danger',
            'message' => 'Level 1 commission must be greater than level 2 commision'
        ]);

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
        $sp->level1_comm = $request->level1_comm;
        $sp->level2_comm = $request->level2_comm;
        if ($request->file('image')) {
            $image = $request->file('image')->store(
                'uploads/storeProduct/' . Auth::user()->username,
                'public'
            );
            $sp->image = $image;
        }
        $sp->store_id = $request->store_id;

        // check if level1_comm <= level2_comm... then fail
        if ($request->level1_comm <= $request->level2_comm) return back()->with([
            'type' => 'danger',
            'message' => 'Level 1 commission must be greater than level 2 commision'
        ]);

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
}
