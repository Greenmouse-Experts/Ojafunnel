<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.adminwelcome');
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

    public function manage_plans()
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
        return view('admin.subscribtions');
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

    public function sales_list()
    {
        return view('admin.ecommerce.salesList');
    }
}
