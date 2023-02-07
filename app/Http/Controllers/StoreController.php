<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;
use Auth;


class StoreController extends Controller
{
    //
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

    public function shops($username)
    {
        $store = Store::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.Shops', compact('username', 'store'));
    }

    public function storeFront(Request $request)
    {
        $store = Store::latest()->where('name', $request->storename)->first();
        return view('dashboard.mystoree', compact('store'));
    }

    public function available_product($username)
    {
        return view('dashboard.AvailableProduct', [
            'username' => $username
        ]);
    }
}
