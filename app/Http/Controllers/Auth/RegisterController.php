<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    private $header;

    public function __construct()
    {
        $this->header = ["Accept" =>  "application/json", "Content-Type" => "application/json"];
    }

    public function create(Request $request)
    {
        // $response = Http::acceptJson()->withHeaders($this->header)->get($endpoint);
        $endpoint = config('app.url_site')."/api/v1/auth/register";
        $response = Http::acceptJson()->withHeaders($this->header)->post($endpoint, $request);
        $ApiResponse = $response->json();

        // return dd($ApiResponse);
        if($ApiResponse['success'] === true){
            return redirect()->route('emailverification')->with('email', $ApiResponse['data']['email']); 
        }else{  
            return back()->withInput()->with([
                'type' => 'danger',
                'message' => $ApiResponse['message']
            ]);
        }
    }

    public function emailverify(Request $request)
    {
        // $response = Http::acceptJson()->withHeaders($this->header)->get($endpoint);
        $endpoint = config('app.url_site')."/api/v1/auth/verify_email";
        $response = Http::acceptJson()->withHeaders($this->header)->post($endpoint, $request);
        $ApiResponse = $response->json();

        // return dd($ApiResponse);
        if($ApiResponse['success'] === true){
            return redirect()->route('login')->with('site', $ApiResponse['data']['site']); 
        }else{  
            return back()->withInput()->with([
                'type' => 'danger',
                'message' => $ApiResponse['message']
            ]);
        }
    }
}
