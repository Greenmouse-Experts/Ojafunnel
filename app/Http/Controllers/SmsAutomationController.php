<?php

namespace App\Http\Controllers;

use App\Models\TwilioIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tzsk\Sms\Facades\Sms;

class SmsAutomationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    
}
