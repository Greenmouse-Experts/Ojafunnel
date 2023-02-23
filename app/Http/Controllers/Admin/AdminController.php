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
        return view('Admin.user.view-users');
    }

    public function users_details()
    {
        return view('Admin.user.users-details');
    }

    public function add_plans()
    {
        return view('Admin.add-plans');
    }

    public function manage_plans()
    {
        return view('Admin.manage-plans');
    }

    public function viewmessage()
    {
        return view('Admin.viewmessages');
    }

    public function transactions()
    {
        return view('Admin.transaction');
    }

    public function subscriptions()
    {
        return view('Admin.subscription.subscriptions');
    }

    public function unscribers()
    {
        return view('Admin.subscription.unscribers');
    }

    public function security()
    {
        return view('Admin.securitySettings');
    }

    public function general()
    {
        return view('Admin.generalSettings');
    }

    public function subscribtions()
    {
        return view('Admin.subscription.subscriptions');
    }

    public function vendorlist()
    {
        return view('Admin.vendorList');
    }

    public function trans_details()
    {
        return view('Admin.TransDetails');
    }

    public function affiliateList()
    {
        return view('Admin.affiliateList');
    }

    public function product()
    {
        return view('Admin.product');
    }

    public function addProduct()
    {
        return view('Admin.addProduct');
    }

    public function viewCart()
    {
        return view('Admin.viewCart');
    }

    public function view_course()
    {
        return view('Admin.lms.courses');
    }

    public function course_detail()
    {
        return view('Admin.lms.viewCourse');
    }

    public function store_list()
    {
        return view('Admin.ecommerce.storeList');
    }

    public function product_list()
    {
        return view('Admin.ecommerce.productList');
    }

    public function sales_list()
    {
        return view('Admin.ecommerce.salesList');
    }

    public function email_support()
    {
        return view('Admin.support.emailSupport');
    }

    public function chat_support()
    {
        return view('Admin.support.chatSupport');
    }

    public function sms_automation()
    {
        return view('Admin.automation.smsAutomation');
    }

    public function whatsapp_automation()
    {
        return view('Admin.automation.whatsappAutomation');
    }
    // EMAIL-MARKETING

    public function index()
    {
        return view('Admin.emailmarketing.SendingServer');
    }

    public function new_server()
    {
        return view('Admin.emailmarketing.NewServer');
    }

    public function choose_server()
    {
        return view('Admin.emailmarketing.ChooseServer');
    }

    public function main_bounce()
    {
        return view('Admin.emailmarketing.BounceHandler');
    }

    public function new_bounce()
    {
        return view('Admin.emailmarketing.NewBounce');
    }

    public function main_email()
    {
        return view('Admin.emailmarketing.EmailVerification');
    }

    public function create_new()
    {
        return view('Admin.emailmarketing.CreateNew');
    }
}
