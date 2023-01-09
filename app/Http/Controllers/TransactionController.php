<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
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

    public function transaction_confirm($response, $amount)
    {
        $user = User::findorfail(Auth::user()->id);

        $user->update([
            'wallet' => $user->wallet + $amount
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'reference' => $response,
            'status' => 'Top Up'
        ]);

        return redirect()->route('user.transaction', $user->username)->with([
            'type' => 'success',
            'message' => 'Deposited Successfully'
        ]);  
    }
}
