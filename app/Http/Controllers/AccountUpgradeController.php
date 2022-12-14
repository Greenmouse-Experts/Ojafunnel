<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AccountUpgradeController extends Controller
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

    public function upgrade_account($amount)
    {
        $amount = Crypt::decrypt($amount);

        $user = User::findorfail(Auth::user()->id);

        return view('dashboard.makePayment', [
            'amount' => $amount,
            'user' => $user
        ]);
    }

    public function upgrade_account_confirm($plan_id, $response, $amount)
    {
        $planId = Crypt::decrypt($plan_id);
        $Amount = Crypt::decrypt($amount);

        dd($planId, $response, $Amount);

        $user = User::findorfail(Auth::user()->id);

        $plan = Plan::where('id', $planId)->where('');


    }
}
