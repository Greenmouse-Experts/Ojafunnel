<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\Mailinglist;
use App\Models\Subscriber;
use App\Models\TwilioIntegration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client as twilio;
use Tzsk\Sms\Facades\Sms;
use GuzzleHttp\Client;

class SmsAutomationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function sms_sendmessage_campaign(Request $request)
    {
        if ($request->mailinglist_id == null and $request->contacts !== null) {
            //Validate Request
            $this->validate($request, [
                'campaign_name' => ['required', 'string', 'max:255'],
                'sender_name' => ['required', 'string', 'max:255'],
                'message' => ['required', 'string', 'max:255'],
                'contacts' => ['required', 'string', 'max:255'],
                'optout_message' => ['required', 'string', 'max:255'],
                'message_timimg' => ['required', 'string', 'max:255'],
                'integration' => ['required', 'string', 'max:255'],
            ]);

            if ($request->message_timing == "Schedule") {
                $this->validate($request, [
                    'schedule_date' => ['required', 'string', 'max:255'],
                    'schedule_time' => ['required', 'string', 'max:255'],
                ]);
            }

            if ($request->integration == "Twilio") {
                $message = $this->sendMessageTwilio($request);

                dd($message);
            }

            if ($request->integration == "Multitexter") {
                try {
                    $contact = array($request->contacts);

                    $data = implode(',', $contact);

                    $message = $this->sendMessageMultitexter($request, $data);

                    return back()->with([
                        'type' => 'success',
                        'message' => $message->msg
                    ]);
                } catch (Exception $e) {
                    $data = "Contact format invalid";
                }

                return back()->with([
                    'type' => 'danger',
                    'message' => $data
                ]);
            }

            if ($request->integration == "NigeriaBulkSms") {
                try {
                    $contact = array($request->contacts);

                    $data = implode(',', $contact);

                    $message = $this->sendMessageNigeriaBulkSms($request, $data);

                    if(str_contains($message, 'Message sent'))
                    {
                        return back()->with([
                            'type' => 'success',
                            'message' => $message
                        ]);
                    } else {
                        return back()->with([
                            'type' => 'danger',
                            'message' => $message
                        ]);
                    }
                } catch (Exception $e) {
                    $data = "Contact format invalid";
                }

                return back()->with([
                    'type' => 'danger',
                    'message' => $data
                ]);
            }
        } elseif ($request->contacts == null and $request->mailinglist_id !== null) {
            //Validate Request
            $this->validate($request, [
                'campaign_name' => ['required', 'string', 'max:255'],
                'sender_name' => ['required', 'string', 'max:255'],
                'message' => ['required', 'string', 'max:255'],
                'mailinglist_id' => ['required', 'string', 'max:255'],
                'optout_message' => ['required', 'string', 'max:255'],
                'message_timimg' => ['required', 'string', 'max:255'],
                'integration' => ['required', 'string', 'max:255'],
            ]);

            if ($request->message_timing == "Schedule") {
                $this->validate($request, [
                    'schedule_date' => ['required', 'string', 'max:255'],
                    'schedule_time' => ['required', 'string', 'max:255'],
                ]);
            }

            if ($request->integration == "Multitexter") {
                $data = "No Contact";

                $message = $this->sendMessageMultitexter($request, $data);

                return back()->with([
                    'type' => 'success',
                    'message' => $message->msg
                ]);
            }

            if ($request->integration == "NigeriaBulkSms") {
                $data = "No Contact";

                $message = $this->sendMessageNigeriaBulkSms($request, $data);

                if(str_contains($message, 'Message sent'))
                {
                    return back()->with([
                        'type' => 'success',
                        'message' => $message
                    ]);
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => $message
                    ]);
                }
            }
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Please check your field and try again!'
            ]);
        }

        // Mailinglist::create([
        //     'user_id' => Auth::user()->id,
        //     'mailinglist_name' => ucfirst($request->name)
        // ]);

        // return back()->with([
        //     'type' => 'success',
        //     'message' => 'Maillist Added Successfully!'
        // ]); 
    }

    public function sendMessageTwilio(Request $request)
    {
        if ($request->mailinglist_id == null) {

            $integration = Integration::where('type', $request->integration)->first();

            // try {
            $sid = $integration->sid; // Your Account SID from www.twilio.com/console
            $auth_token = $integration->token; // Your Auth Token from www.twilio.com/console
            $from_number = $integration->from; // Valid Twilio number

            $client = new Client($sid, $auth_token);

            $client->messages->create(
                $request->contacts,
                [
                    // 'messagingServiceSid' => 'MGf6365de4f7bbe21390e3a36580d6b7a1',
                    'from' => $from_number,
                    'body' => '$request->message'
                ]
            );

            // } catch(Exception $e) {
            //     $client = "Phone number is not valid";
            // }  

            return $client;
        } elseif ($request->contacts == null) {
        }
    }

    public function sendMessageMultitexter(Request $request, $data)
    {
        if ($request->mailinglist_id == null and $request->contacts !== null) {

            $integration = Integration::where('type', $request->integration)->first();

            try {
                $datum = $data;

                $email = $integration->email;
                $password = $integration->password;
                $message = $request->message;
                $sender_name = $request->sender_name;
                $recipients = $datum;
                $api_key = $integration->api_key;

                $client = new Client(); //GuzzleHttp\Client
                $url = "https://app.multitexter.com/v2/app/sendsms";

                $params = [
                    "email" => $email,
                    "password" => $password,
                    "sender_name" => $sender_name,
                    "message" => $message,
                    "recipients" => $recipients
                ];

                $headers = [
                    'Authorization' => 'Bearer ' . $api_key
                ];

                $response = $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                ]);

                $responseBody = json_decode($response->getBody());
            } catch (Exception $e) {
                $responseBody = $e;
            }

            return $responseBody;
        } elseif ($request->contacts == null and $request->mailinglist_id !== null) {
            $contacts = Subscriber::where('mailinglist_id', $request->mailinglist_id)->get('phone_number');

            $integration = Integration::where('type', $request->integration)->first();

            $d = $contacts->toArray();;
            $data = [];

            foreach ($d as $val) {
                $str = implode(',', $val);
                $data[] = $str;
            }
            $datum = implode(',', $data);

            $email = $integration->email;
            $password = $integration->password;
            $message = $request->message;
            $sender_name = $request->sender_name;
            $recipients = $datum;
            $api_key = $integration->api_key;

            try {
                $client = new Client(); //GuzzleHttp\Client
                $url = "https://app.multitexter.com/v2/app/sendsms";

                $params = [
                    "email" => $email,
                    "password" => $password,
                    "sender_name" => $sender_name,
                    "message" => $message,
                    "recipients" => $recipients
                ];

                $headers = [
                    'Authorization' => 'Bearer ' . $api_key
                ];

                $response = $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                ]);

                $responseBody = json_decode($response->getBody());
            } catch (Exception $e) {
                $responseBody = $e;
            }

            return $responseBody;
        }
    }

    public function sendMessageNigeriaBulkSms(Request $request, $data)
    {
        if ($request->mailinglist_id == null and $request->contacts !== null) {

            $integration = Integration::where('type', $request->integration)->first();

            $datum = $data;

            // Initialize variables ( set your variables here )
            $username = $integration->username;
            $password = $integration->password;
            $sender   = $request->sender_name;
            $message  = $request->message;
            $recipients = $datum;

            try {
                /*
                    Sending messages using our API
                    Requirements - PHP, cURL (enabled) function
                */

                // Separate multiple numbers by comma

                $mobiles  = $recipients;

                // Set your domain's API URL

                $api_url  = 'http://portal.nigeriabulksms.com/api/?';


                //Create the message data

                $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $message, 'mobiles' => $mobiles);

                //URL encode the message data

                $data = http_build_query($data);

                //Send the message

                $ch = curl_init(); // Initialize a cURL connection

                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                $result = curl_exec($ch);

                $result = json_decode($result);


                if (isset($result->status) && strtoupper($result->status) == 'OK') {
                    // Message sent successfully, do anything here

                    return 'Message sent at N' . $result->price;
                } else if (isset($result->error)) {
                    // Message failed, check reason.

                    return 'Message failed - error: ' . $result->error;
                } else {
                    // Could not determine the message response.

                    return 'Unable to process request';
                }
            } catch (Exception $e) {
                $responseBody = $e;
            }

            return $responseBody;
        } elseif ($request->contacts == null and $request->mailinglist_id !== null) {
            $contacts = Subscriber::where('mailinglist_id', $request->mailinglist_id)->get('phone_number');

            $integration = Integration::where('type', $request->integration)->first();
            
            $d = $contacts->toArray();;
            $data = [];

            foreach ($d as $val) {
                $str = implode(',', $val);
                $data[] = $str;
            }
            $datum = implode(',', $data);

            // Initialize variables ( set your variables here )
            $username = $integration->username;
            $password = $integration->password;
            $sender   = $request->sender_name;
            $message  = $request->message;
            $recipients = $datum;

            try {
                /*
                    Sending messages using our API
                    Requirements - PHP, cURL (enabled) function
                */

                // Separate multiple numbers by comma

                $mobiles  = $recipients;

                // Set your domain's API URL

                $api_url  = 'http://portal.nigeriabulksms.com/api/?';


                //Create the message data

                $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $message, 'mobiles' => $mobiles);

                //URL encode the message data

                $data = http_build_query($data);

                //Send the message

                $ch = curl_init(); // Initialize a cURL connection

                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                $result = curl_exec($ch);

                $result = json_decode($result);


                if (isset($result->status) && strtoupper($result->status) == 'OK') {
                    // Message sent successfully, do anything here

                    return 'Message sent at N' . $result->price;
                } else if (isset($result->error)) {
                    // Message failed, check reason.

                    return 'Message failed - error: ' . $result->error;
                } else {
                    // Could not determine the message response.

                    return 'Unable to process request';
                }
            } catch (Exception $e) {
                $responseBody = $e;
            }

            return $responseBody;
        }
    }
}
