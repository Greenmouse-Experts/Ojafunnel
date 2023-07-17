<?php

namespace App\Http\Controllers;

use App\Models\OjaPlanParameter;
use App\Models\OrderItem;
use App\Models\OrderUser;
use App\Models\StoreOrder;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;
use App\Models\StoreCoupon;
use Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File as FacadeFile;
use Carbon\Carbon;

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
                // 'theme' => 'required'
            ],
            [
                'name.unique' => 'Store name has already been taken, please use another one!',
            ]
        );

        if (Store::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->store) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        if ($request->primaryColor == '#000000') {
            $request->validate(
                [
                    'theme' => 'required'
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
        } else {
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
            $store->theme = $request->primaryColor;
            $store->color = '#fff';
            $store->user_id = \Auth::user()->id;
            $store->save();
        }

        return back()->with([
            'type' => 'success',
            'message' => $request->name . ' store created successfully'
        ]);
    }

    public function updateStore(Request $request)
    {
        if ($request->primaryColor == '#000000') {
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
        } else {
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
            $store->theme = $request->primaryColor;
            $store->color = '#fff';
            $store->user_id = Auth::user()->id;
            $store->update();
        }

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
        return view('dashboard.Sales', [
            'username' => $username,
            'order' => $order,
            'store' => $store,
        ]);
    }

    public function order_details(Request $request, $username)
    {
        $order = StoreOrder::latest()->where('id', $request->id)->first();
        // dd($order->store_id);
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
            'price' => 'required|numeric',
            'image' => 'required|image',
            'quantity' => 'required',
            'level1_comm' => 'required',
            'level2_comm' => 'required',
        ]);

        if (StoreProduct::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->products) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

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
        $sp->user_id = Auth::user()->id;
        $sp->type = 'Physical';

        if ($request->level1_comm < 0 || $request->level2_comm < 0) return back()->with([
            'type' => 'danger',
            'message' => 'Negative value are not allowed for commission fields'
        ]);

        if ($request->level1_comm != 0 && $request->level2_comm != 0) {
            // check if level1_comm <= level2_comm... then fail
            if ($request->level1_comm <= $request->level2_comm) return back()->with([
                'type' => 'danger',
                'message' => 'Level 1 commission must be greater than level 2 commision'
            ]);
        }

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

    public function addDigitalProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'quantity' => 'required',
            'level1_comm' => 'required',
            'level2_comm' => 'required',
            'content_type' => 'required',
        ]);

        $validator = Validator::make(
            [
                'file'      => $request->file,
                'extension' => strtolower($request->file->getClientOriginalExtension()),
                'size' => strtolower($request->file->getSize())
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:mp3,pdf,mp4',
                'size' => 'required|max:102400'
            ]
        );

        if($validator->fails()){
            return back()->with([
                'type' => 'danger',
                'message' => 'The selected file format is invalid or file size greater than 100MB'
            ]); 
        }

        if (StoreProduct::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->products) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        if ($request->file('image')) {
            $image = $request->file('image')->store(
                'uploads/storeProduct/' . Auth::user()->username,
                'public'
            );
        }

        try {

            $productFile = request()->file->getClientOriginalName();

            $filename = pathinfo($productFile, PATHINFO_FILENAME);

            $response = cloudinary()->uploadFile(
                $request->file('file')->getRealPath(),
                [
                    'folder' => config('app.name'),
                    "public_id" => $filename,
                    "use_filename" => TRUE
                ]
            )->getSecurePath();

            $sp = new StoreProduct();
            $sp->name = $request->name;
            $sp->content_type = $request->content_type;
            $sp->link = $response;
            $sp->description = $request->description;
            $sp->price = $request->price;
            $sp->quantity = $request->quantity;
            $sp->level1_comm = $request->level1_comm;
            $sp->level2_comm = $request->level2_comm;
            $sp->image = $image;
            $sp->store_id = $request->store_id;
            $sp->user_id = Auth::user()->id;
            $sp->type = 'Digital';

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
        } catch (Exception $e) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to add product, please try again.'
            ]);
        }
    }

    public function updateDigitalProduct(Request $request)
    {
        $sp = StoreProduct::findOrFail($request->id);
        $sp->name = $request->name;
        $sp->content_type = $request->content_type;
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


        $token = explode('/', $sp->link);
        $token2 = explode('.', $token[sizeof($token) - 1]);

        if ($sp->link) {
            cloudinary()->destroy(config('app.name') . '/' . $token2[0]);
        }

        if ($request->file('file')) {
            $productFile = request()->file->getClientOriginalName();

            $filename = pathinfo($productFile, PATHINFO_FILENAME);

            $response = cloudinary()->uploadFile(
                $request->file('file')->getRealPath(),
                [
                    'folder' => config('app.name'),
                    "public_id" => $filename,
                    "use_filename" => TRUE
                ]
            )->getSecurePath();

            $sp->link = $response;
        }



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

    public function storeCoupon()
    {
        return view('dashboard.store.coupon');
    }

    public function storeCreateCoupon(Request $request)
    {
        $request->validate([
            'store_id' => 'required',
            'coupon_code' => 'required|unique:store_coupons',
            'discount_percent' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $store = Store::find($request->store_id);

        if($store)
        {
            StoreCoupon::create([
                'user_id' => Auth::user()->id,
                'store_id' => $store->id,
                'coupon_code' => $request->coupon_code,
                'discount_percent' => $request->discount_percent,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Coupon added successfully.'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => 'Store not found in our database'
        ]);
    }

    public function storeUpdateCoupon($id, Request $request)
    {
        $request->validate([
            'store_id' => 'required',
            'coupon_code' => 'required',
            'discount_percent' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $finder = Crypt::decrypt($id);

        $store = Store::find($request->store_id);

        if($store)
        {
            $coupon = StoreCoupon::find($finder);

            $coupon->update([
                'store_id' => $store->id,
                'coupon_code' => $request->coupon_code,
                'discount_percent' => $request->discount_percent,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Coupon updated successfully.'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => 'Store not found in our database'
        ]);
    }

    public function storeDeleteCoupon($id)
    {
        $finder = Crypt::decrypt($id);

        $coupon = StoreCoupon::findOrFail($finder);

        $coupon->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Coupon deleted successfully.'
        ]);
    }

}
