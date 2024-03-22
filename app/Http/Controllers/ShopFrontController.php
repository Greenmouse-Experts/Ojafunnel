<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Models\Course;
use App\Models\CoursePromotion;
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
use App\Models\PaymentGateway;
use App\Models\UserPaymentGateway;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Stripe;
use Stripe\Exception\CardException;
use Stripe\StripeClient;



class ShopFrontController extends Controller
{
    public function shopFront(Request $request)
    {
        $currentUrl = URL::current();

        $shop = Shop::latest()->where('name', $request->shopname)->first();

        // return $request->shopname;

        if($request->has('search_string'))
        {
            $searchTerm = $request->search_string;

            $courses = Course::latest()
            ->where('user_id', $shop->user_id)->where('approved', true)
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->orWhere('subtitle', 'like', "%$searchTerm%");
            })
            ->get();

        } else {
            $courses = Course::latest()->where(['user_id' => $shop->user_id, 'shop_id' => $shop->id])->where('approved', true)->get();
        }

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

    public function addCourseToCart($id, $shopname)
    {
        $course = Course::find($id);
        $shop = Shop::latest()->where('name', $shopname)->first();
        $cart = session()->get('cart', []);

        $cart[$id] = [
            "id" => $course->id,
            "title" => $course->title,
            "currency" => $shop->currency,
            "currency_sign" => $shop->currency_sign,
            "price" => $course->price,
            "description" => $course->description,
            "image" => $course->image,
            "shop" => $shop
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

    public function course_checkout(Request $request)
    {
        $shop = Shop::latest()->where('name', $request->shopname)->first();
        $courses = Course::latest()->where('user_id', $shop->user_id)->get();
        $countries = \App\Models\Country::countries();
        $paymentGateway = UserPaymentGateway::where(['user_id' => $shop->user_id, 'name' => $shop->payment_gateway])->first();

        return view('dashboard.lms.checkout', compact('shop', 'courses', 'countries', 'paymentGateway'));
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
        // return $promotion_id && $course_id
        //     ? $this->checkoutPaymentWithPromotion($request, $promotion_id, $course_id)
        //     : $this->checkoutPaymentWithoutPromotion($request);

        return $this->checkoutPaymentWithPromotion($request, $promotion_id, $course_id);
    }

    public function checkoutPaymentWithPromotion(Request $request, $promotion_id, $course_id)
    {
        $shop = Shop::where('name', $request->shopname)->first();

        $cart = session()->get('cart');

        $totalAmount = 0;

        $promoter = User::where(['promotion_link' => $promotion_id]);

        foreach ($cart as $item) {
            if (isset($item['shop']) && $item['shop']->name == $shop->name) {
                $totalAmount += $item['price'];
            }
        }

        if($request->paymentOptions == 'Stripe')
        {
            // Fetch PaymentGateway details from the database
            $paymentGateway = PaymentGateway::where('name', 'Stripe')->first();

            try {
                $stripe = new StripeClient($paymentGateway->STRIPE_SECRET);

                $stripe->paymentIntents->create([
                    'amount' => $totalAmount * 100,
                    'currency' => $shop->currency,
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
        $trans->amount = $shop->currency_sign.''.$totalAmount;
        $trans->reference = 'Payment from ' . $enroll->name . ' with order no: ' . $enroll->order_no;
        $trans->status = 'Course Purchase';
        $trans->save();

        $data = [];

        foreach ($cart as $item) {
            if (isset($item['shop']) && $item['shop']->name == $shop->name) {
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
                    $product = Course::find($item['id']);

                    // promoter fee
                    $level1_fee = ($product->level1_comm / 100) * $item['price'];

                    if ($promoter->first()->referral_link != null || $promoter->first()->referral_link != "") {
                        // promoter's refer by free
                        $level2_fee = ($product->level2_comm / 100) * $item['price'];
                    }

                    $item_amount = $item['price'] - ($level1_fee + $level2_fee);
                } else $item_amount = $item['price'];

                $shopOrder = ShopOrder::create([
                    'shop_id' => $shop->id,
                    'course_id' => $item['id'],
                    'enrollment_id' => $enroll->id,
                    'order_no' => $enroll->order_no,
                    'payment_method' => $request->paymentOptions,
                    'amount' => $item['price'],
                    'description' => $request->name . ' purchase/enroll on a course published in your shop.',
                    'transaction_id' => $trans->id,
                    'type' => $item['id'] == $course_id && $promoter->exists() ? 'Promotion' : 'Normal',
                ]);

                // add fund to vendor wallet
                $userData = ModelsUser::findOrFail($shop->user_id);
                // if($shop->currency == 'NGN')
                // {
                //     $userData->wallet = $userData->wallet + $item_amount;
                // } else {
                //     $userData->dollar_wallet = $userData->dollar_wallet + $item_amount;
                // }
                // $userData->update();

                OjafunnelNotification::create([
                    'to' => $userData->id,
                    'title' => config('app.name'),
                    'body' => $request->name . ' purchase/enroll on a course published in your shop.'
                ]);

                // add fund to promoter and promoter referral wallet
                if ($item['id'] == $course_id && $promoter->exists()) {
                    // level1 fee
                    if($shop->currency == 'NGN')
                    {
                        $promoter->update([
                            'promotion_bonus' => $promoter->first()->promotion_bonus + $level1_fee
                        ]);
                    } else {
                        $promoter->update([
                            'dollar_promotion_bonus' => $promoter->first()->dollar_promotion_bonus + $level1_fee
                        ]);
                    }

                    // add record to transaction table for promoter - (plus)
                    $trans = new Transaction();
                    $trans->user_id = $promoter->first()->id;
                    $trans->amount = $shop->currency_sign."$level1_fee";
                    $trans->reference = Str::random(8);
                    $trans->status = 'Level 1 Fee Received';
                    $trans->save();

                    // notify level 1 here
                    CoursePromotion::create([
                        'promoter_id' =>  $promoter->first()->id,
                        'shop_order_id' => $shopOrder->id,
                        'shop_owner_id' => $shop->user_id,
                        'shop_id' => $shop->id,
                        'transaction_id' => $trans->id,
                        'amount' => $level1_fee,
                        'type' => 'Course'
                    ]);

                    // level2 fee
                    if ($promoter->first()->referral_link != null || $promoter->first()->referral_link != "") {
                        $user = User::where(['id' => $promoter->first()->referral_link]);

                        if($shop->currency == 'NGN')
                        {
                            $user->update([
                                'promotion_bonus' => $user->first()->promotion_bonus + $level2_fee
                            ]);
                        } else {
                            $user->update([
                                'dollar_promotion_bonus' => $user->first()->dollar_promotion_bonus + $level2_fee
                            ]);
                        }

                        // add record to transaction table for promoter referral - (plus)
                        $trans = new Transaction();
                        $trans->user_id = $user->first()->id;
                        $trans->amount = $shop->currency_sign."$level2_fee";
                        $trans->reference = Str::random(8);
                        $trans->status = 'Level 2 Fee Received';
                        $trans->save();

                        // notify level 2 here
                        CoursePromotion::create([
                            'promoter_id' =>  $user->first()->id,
                            'shop_order_id' => $shopOrder->id,
                            'shop_owner_id' => $shop->user_id,
                            'shop_id' => $shop->id,
                            'transaction_id' => $trans->id,
                            'amount' => $level2_fee,
                            'type' => 'Course'
                        ]);
                    }
                }
            }
        }

        $userData = ModelsUser::findOrFail($shop->user_id);

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
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'];
        }

        if($request->paymentOptions == 'Stripe')
        {
            // Fetch PaymentGateway details from the database
            $paymentGateway = PaymentGateway::where('name', 'Stripe')->first();

            try {
                $stripe = new StripeClient($paymentGateway->STRIPE_SECRET);

                $stripe->paymentIntents->create([
                    'amount' => $totalAmount * 100,
                    'currency' => $shop->currency,
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
        $trans->amount = $shop->currency_sign.''.$totalAmount;
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
        if($shop->currency == 'NGN')
        {
            $userData->wallet = $userData->wallet + $totalAmount;
        } else {
            $userData->dollar_wallet = $userData->dollar_wallet + $totalAmount;
        }
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
