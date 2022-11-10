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

    public function integration_twilio_create(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'sid' => ['required', 'string', 'max:255'],
            'token' => ['required', 'string', 'max:255'],
            'from' => ['required', 'numeric'],
        ]);

        TwilioIntegration::create([
            'user_id' => Auth::user()->id,
            'sid' => $request->sid,
            'token' => $request->token,
            'from' => $request->from
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Twilio Integration Created Successfully!'
        ]); 
    }
}
