<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    private $header;

    public function __construct()
    {
        $this->header = ["Accept" =>  "application/json", "Content-Type" => "application/json"];
    }

    public function login(Request $request)
    {
        // $response = Http::acceptJson()->withHeaders($this->header)->get($endpoint);
        $endpoint = config('app.url_site')."/api/v1/auth/login";
        $response = Http::acceptJson()->withHeaders($this->header)->post($endpoint, $request);
        $ApiResponse = $response->json();

        // return dd($ApiResponse);
        if($ApiResponse['success'] === true){
            if($ApiResponse['data']['hasVerifiedEmail'] === true){
                Session::put('AuthAccessToken', $ApiResponse['data']['accessToken']);
                return redirect()->route('user.dashboard')->with('site', $ApiResponse['data']['subdomain']);
            }else{

                //write send re send code here

                return redirect()->route('emailverification')->with('email', $ApiResponse['data']['email']);
            } 
        }else{  
            return back()->withInput()->with([
                'type' => 'danger',
                'message' => $ApiResponse['message']
            ]);
        }
    }
}
