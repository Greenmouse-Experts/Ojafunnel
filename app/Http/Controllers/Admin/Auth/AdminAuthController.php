<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('auth.admin');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = auth()->guard('admin')->user();
            //dd($user->adminGroup->name);
            if ($user->adminGroup->name == "Administrator") {
                return redirect()->route('adminDashboard')->with('success', 'You are Logged in successfully.');
            }
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        //dd('hi');
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You have successfully logout');
        return redirect(route('adminLogin'));
    }
}
