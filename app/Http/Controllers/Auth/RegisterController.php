<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    private $header, $secretKey;

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

        // return dd();

        return back()->with([
            'type' => 'danger',
            'message' => $ApiResponse['message']
        ]); 
    }
}
