<?php

namespace App\Http\Controllers;

use App\Models\AffiliateBonus;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tzsk\Sms\Facades\Sms;
use GuzzleHttp\Client;

class AdminController extends Controller
    {
        //
        public function adminwelcome()
        {
            return view('admin.adminwelcome');
        }

        public function view_users()
        {
            return view('admin.user.view-users');
        }

        public function users_details()
        {
            return view('admin.user.users-details');
        }

        public function add_plans()
        {
            return view('admin.add-plans');
        }

        public function  manage_plans()
        {
            return view('admin.manage-plans');
        }

        public function viewmessage()
        {
            return view('admin.viewmessages');
        }

        public function transactions()
        {
            return view('admin.transaction');
        }

        public function subscriptions()
        {
            return view('admin.subscription.subscriptions');
        }

        public function unscribers()
        {
            return view('admin.subscription.unscribers');
        }

        public function security()
        {
            return view('admin.securitySettings');
        }

        public function general()
        {
            return view('admin.generalSettings');
        }

        public function subscribtions()
        {
            return view('admin.subscription.subscriptions');
        }

        public function vendorlist()
        {
            return view('admin.vendorList');
        }

        public function trans_details()
        {
            return view('admin.TransDetails');
        }

        public function affiliateList()
        {
            return view('admin.affiliateList');
        }

        public function product()
        {
            return view('admin.product');
        }

        public function addProduct()
        {
            return view('admin.addProduct');
        }

        public function viewCart()
        {
            return view('admin.viewCart');
        }

        public function view_course()
        {
            return view('admin.lms.courses');
        }

        public function add_category(Request $request)
        {


            return view('admin.lms.courses');
        }

        public function update_category()
        {
            return view('admin.lms.courses');
        }

        public function delete_category()
        {
            return view('admin.lms.courses');
        }

        public function course_detail()
        {
            return view('admin.lms.viewCourse');
        }

        public function store_list()
        {
            return view('admin.ecommerce.storeList');
        }

        public function product_list()
        {
            return view('admin.ecommerce.productList');
        }

        public function product_detail()
        {
            return view('admin.ecommerce.productDetail');
        }

        public function sales_list()
        {
            return view('admin.ecommerce.salesList');
        }

}
