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
        $this->secretKey = "new";
        $this->header = ["x-access-token" =>  "$this->secretKey", "Content-Type" => "application/json"];
    }

    public function create(Request $request)
    {
        // $response = Http::acceptJson()->withHeaders($this->header)->get($endpoint);
        // $endpoint = env('API_URL_SITE');
        // $response = Http::acceptJson()->withHeaders($this->header)->post($endpoint,$request);
        // $gatewayResponse = $response->json();

        return dd($request);
    }
}
