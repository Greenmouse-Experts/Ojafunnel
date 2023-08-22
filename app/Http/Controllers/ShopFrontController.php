<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Course;
use App\Models\ShopOrder;
use App\Models\Enrollment;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\OjafunnelNotification;
use Illuminate\Support\Facades\Crypt;
use Stripe;



class ShopFrontController extends Controller
{
    public function shopFront(Request $request)
    {
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        $courses = Course::latest()->where('user_id', $shop->user_id)->get();

        $isvalid = false;

        if ($request->has('promotion_id')) {
            $user = User::where('promotion_link', $request->promotion_id);

            // if user exist then promotion code is valid
            if ($user->exists()) {
                $isvalid = true;

                return view('dashboard.lms.viewShop', compact('shop', 'courses', 'isvalid'));
            } else return view('dashboard.lms.viewShop', compact('shop', 'courses', 'isvalid'));
            //
        } else return view('dashboard.lms.viewShop', compact('shop', 'courses', 'isvalid'));
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
        $courses = Course::latest()->where('user_id', $shop->user_id)->get();
        return view('dashboard.lms.cart', compact('shop', 'courses'));
    }


    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([

                "amount" => 100 * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com."
        ]);
        Session::flash('success', 'Payment successful!');
        return back();
    }


    public function stripe_pay(Request $request){
        $user = auth('user')->user();
        //\Cart::clear();
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $response = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Service payments from Sharreit"
            ]);
            if($response){

                return $response;
            }

            return response()->json([
                'status' => 'error',
                'msg' => $response,
                'data' => ''
            ],400);

        } catch (ClientException $e) {
            $response = $e->getResponse();
            $response_body = json_decode($response->getBody(), true);

            return response()->json([
                'status' => 'failed',
                'message' => $response_body['error']['message'],
                'data' => ''
            ],400);

        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occured: '.$e->getMessage(),
            ],400);
        }
        return response()->json([
            'status' => 'failed',
            'msg' => $response,
            'data' => ''
        ],400);
    }



    public function course_checkout(Request $request)
    {
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        $courses = Course::latest()->where('user_id', $shop->user_id)->get();
        $countries = \App\Models\Country::countries();

        return view('dashboard.lms.checkout', compact('shop', 'courses', 'countries'));
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
        $promotion_id = $request->has('promotion_id') ? $request->get('promotion_id') : null;
        $course_id = $request->has('course_id') ? $request->get('course_id') : null;

        // is there any promotion link?
        return $promotion_id && $course_id
            ? $this->checkoutPaymentWithPromotion($request, $promotion_id, $course_id)
            : $this->checkoutPaymentWithoutPromotion($request);
    }

    public function checkoutPaymentWithPromotion(Request $request, $promotion_id, $course_id)
    {
        $shop = Shop::where('name', $request->shopname)->first();

        $cart = session()->get('cart');

        $totalAmount = 0;

        $promoter = User::where(['promotion_link' => $promotion_id]);

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
        $trans->reference = 'Payment from ' . $enroll->name . ' with order no: ' . $enroll->order_no;
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

            // item total amount
            $item_amount = 0;
            // promoter
            $level1_fee = 0;
            // promoter's refer by
            $level2_fee = 0;
            //

            if ($item['id'] == $course_id && $promoter->exists()) {
                $product = Course::find($item['id'])->first();

                // promoter fee
                $level1_fee = $product->level1_comm / 100 * $item['price'];

                if ($promoter->first()->referral_link != null) {
                    // promoter's refer by free
                    $level2_fee = $product->level2_comm / 100 * $item['price'];
                }

                $item_amount = $item['price'] - ($level1_fee + $level2_fee);
            } else $item_amount = $item['price'];

            $shopOrder = ShopOrder::create([
                'shop_id' => $shop->id,
                'course_id' => $item['id'],
                'enrollment_id' => $enroll->id,
                'order_no' => $enroll->order_no,
                'payment_method' => 'Paystack',
                'amount' => $item['price'],
                'description' => $request->name . ' purchase/enroll on a course published in your shop.',
                'transaction_id' => $trans->id,
                'type' => $item['id'] == $course_id && $promoter->exists() ? 'Promotion' : 'Normal'
            ]);

            // add fund to vendor wallet
            $userData = ModelsUser::findOrFail($shop->user_id);
            $userData->wallet = $userData->wallet + $item_amount;
            $userData->update();

            // add fund to promoter and promoter referral wallet
            if ($item['id'] == $course_id && $promoter->exists()) {
                // level1 fee
                $promoter->update([
                    'wallet' => $promoter->first()->wallet + $level1_fee,
                    'promotion_bonus' => $promoter->first()->promotion_bonus + $level1_fee
                ]);

                // notify level 1 here

                // level2 fee
                if ($promoter->first()->referral_link != null) {
                    $user = User::where(['id' => $promoter->first()->referral_link]);

                    $user->update([
                        'wallet' => $user->first()->wallet + $level2_fee,
                        'promotion_bonus' => $user->first()->promotion_bonus + $level2_fee
                    ]);

                    // notify level 2 here
                }
            }
        }

        $userData = ModelsUser::findOrFail($shop->user_id);

        OjafunnelNotification::create([
            'to' => $userData->id,
            'title' => config('app.name'),
            'body' => $request->name . ' purchase/enroll on a course published in your shop.'
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

    public function checkoutPaymentWithoutPromotion(Request $request)
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
        $trans->reference = 'Payment from ' . $enroll->name . ' with order no: ' . $enroll->order_no;
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
                'description' => $request->name . ' purchase/enroll on a course published in your shop.',
                'transaction_id' => $trans->id
            ]);
        }


        $userData = ModelsUser::findOrFail($shop->user_id);
        $userData->wallet = $userData->wallet + $totalAmount;
        $userData->update();

        OjafunnelNotification::create([
            'to' => $userData->id,
            'title' => config('app.name'),
            'body' => $request->name . ' purchase/enroll on a course published in your shop.'
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

        $isvalid = false;

        if ($request->has('promotion_id')) {
            $user = User::where('promotion_link', $request->promotion_id);

            // if user exist then promotion code is valid
            if ($user->exists()) {
                $isvalid = true;

                return view('dashboard.lms.view_course_details', compact('shop', 'course', 'isvalid'));
            } else return view('dashboard.lms.view_course_details', compact('shop', 'course', 'isvalid'));
            //
        } else return view('dashboard.lms.view_course_details', compact('shop', 'course', 'isvalid'));
    }
}
