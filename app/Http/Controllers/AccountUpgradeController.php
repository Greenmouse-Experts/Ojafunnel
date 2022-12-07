<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AccountUpgradeController extends Controller
{
    public function upgrade_account($amount)
    {
        $amount = Crypt::decrypt($amount);

        $user = User::findorfail(Auth::user()->id);

        return view('dashboard.makePayment', [
            'amount' => $amount,
            'user' => $user
        ]);
    }
}
