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

        public function viewlist()
        {
            return view('admin.viewlist');
        }

        public function viewmessage()
        {
            return view('admin.viewmessages');
        }
}
