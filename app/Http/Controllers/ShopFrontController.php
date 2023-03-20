<?php

namespace App\Http\Controllers;

use Acelle\Model\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\OjafunnelNotification;
use App\Models\Shop;
use App\Models\ShopOrder;
use App\Models\Transaction;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class ShopFrontController extends Controller
{
    public function shopFront(Request $request)
    {
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        $courses = Course::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.lms.viewShop', compact('shop', 'courses'));
    }
    
    public function addCourseToCart($id)
    {
        $course = Course::findOrFail($id);

        $cart = session()->get('cart', []);

        $cart[$id] = [
            "id" => $course->id,
            "title" => $course->title,
            'currency' => $course->currency,
            "price" => $course->price,
            "description" => $course->description,
            "image" => $course->image
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Course added to cart successfully!');
    }
    
    public function course_cart(Request $request)
    {
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        $courses = Course::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.lms.cart', compact('shop', 'courses'));
    }

    public function course_checkout(Request $request)
    {
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        $courses = Course::latest()->where('user_id', Auth::user()->id)->get();
        return view('dashboard.lms.checkout', compact('shop', 'courses'));
    }

    public function course_update(Request $request)
    {
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

    public function courseCheckoutPayment(Request $request)
    {
        $shop = Shop::where('name', $request->shopname)->first();

        $cart = session()->get('cart');
        // dd($cart);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'];
        }

        // dd($request->name, $request->email, $request->phoneNo, $request->address, $request->state, $request->country);

        $enroll = Enrollment::create([
            'shop_id' => $shop->id,
            'order_no' => Str::random(6),
            'email' => $request->email,
            'name' => $request->name,
            'phone_no' => $request->phoneNo,
            'address' => $request->address,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        $trans = new Transaction();
        $trans->user_id = $shop->user_id;
        $trans->amount = $totalAmount;
        $trans->reference = 'Payment from '.$enroll->name.' with order no: '.$enroll->order_no;
        $trans->status = 'Course Purchase';
        $trans->save();

        $data = [];

        foreach ($cart as $item) {
            $data['items'] = [
                [
                    'name' => $item['title'],
                    'price' => $item['price'],
                    'desc' => $item['title'],
                ]
            ];

            $shopOrder = ShopOrder::create([
                'shop_id' => $shop->id,
                'course_id' => $item['id'],
                'enrollment_id' => $enroll->id,
                'order_no' => $enroll->order_no,
                'payment_method' => 'Paystack',
                'amount' => $item['price'],
                'description' => $request->name.' purchase/enroll on a course published in your shop.',
                'transaction_id' => $trans->id
            ]);
        }

        
        $userData = ModelsUser::findOrFail($shop->user_id);
        $userData->wallet = $userData->wallet + $totalAmount;
        $userData->update();

        OjafunnelNotification::create([
            'to' => $userData->id,
            'title' => config('app.name'),
            'body' => $request->name.' purchase/enroll on a course published in your shop.'
        ]);
        
        session()->forget('cart');

        /** Store information to include in mail in $data as an array */
        $data = array(
            'shop' => $shop,
            'enroll' => $enroll,
            'email' => $enroll->email
        );
        
        /** Send message to the user */
        Mail::send('emails.receiptlms', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        $data = [
            'shop' => $shop,
            'enroll' => $enroll,
        ];

        $pdf = PDF::loadView('myPDFlms', $data);

        return view('myPDFlms', compact('shop', 'enroll'));

    }

    public function Pdf()
    {
        $enroll = Enrollment::where('id', 1)->first();
        $shop = Shop::where('name', 'Ojaa')->first();
        $data = [
            'shop' => $shop,
            'enroll' => $enroll
        ];

        $pdf = PDF::loadView('myPDFlms', $data);
        return view('myPDFlms', compact('shop', 'enroll'));
        //dd($store);

        //return $pdf->download('invoice.pdf');
    }

    public function view_course_details(Request $request)
    {
        $Finder = Crypt::decrypt($request->id);

        $course = Course::find($Finder);
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        
        return view('dashboard.lms.view_course_details', compact('course', 'shop'));
    }
}
