<?php

namespace App\Http\Controllers;

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
            return view('admin.view-users');
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
            return view('admin.subscriptions');
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

        public function vendordetails()
        {
            return view('admin.vendorDetails');
        }
        
}
