<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class EmailCampaignController extends Controller
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
    
    //
    public function email_campaign_checker(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
        ]);

        $api_key = config('app.zerobounce_api_key');

        // try {
            $client = new Client(); //GuzzleHttp\Client
            $url = "https://api.zerobounce.net/v2/validate?api_key=$api_key&email=$request->email&ip_address=";

            $response = $client->request('GET', $url);

            $responseBody = json_decode($response->getBody());

            // dd($responseBody);
            if($responseBody->error)
            {
                return back()->with([
                    'type' => 'danger',
                    'message' => $responseBody->error
                ]);
            }
            if($responseBody->status == 'valid')
            {
                return back()->with([
                    'type' => 'success',
                    'message' => $responseBody->status
                ]);
            }
            
        // } catch (Exception $e) {
        //     return back()->with([
        //         'type' => 'danger',
        //         'message' => $e
        //     ]);
        // }
    }
}
