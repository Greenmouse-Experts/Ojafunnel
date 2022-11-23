<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class EmailCampaignController extends Controller
{
    //
    public function email_campaign_checker(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
        ]);

        $api_key = config('app.zerobounce_api_key');

        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.zerobounce.net/v2/validate?api_key=$api_key&email=$request->email&ip_address=";

        $response = $client->request('GET', $url);

        $responseBody = json_decode($response->getBody());

        if($responseBody->status == 'valid')
        {
            return back()->with([
                'type' => 'success',
                'message' => $responseBody->status
            ]);
        }
        
        return back()->with([
            'type' => 'danger',
            'message' => $responseBody->status
        ]);
    }
}
