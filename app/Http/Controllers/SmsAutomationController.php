<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\Mailinglist;
use App\Models\SmsAutomation;
use App\Models\SmsCampaign;
use App\Models\Subscriber;
use App\Models\ContactNumber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client as twilio;
use GuzzleHttp\Client;
use App\Library\Tool;
use App\Models\OjaPlanParameter;
use App\Models\SeriesSmsCampaign;
use Illuminate\Support\Str;
use Aws\Sns\SnsClient;
use Illuminate\Support\Facades\Log;

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
        $messages = [
            'mailinglist_id.required' => 'The list field is required.',
            'integration.required' => 'Please activate or add SMS Integration.'
        ];

        $this->validate($request, [
            'campaign_name' => ['required', 'string', 'max:255'],
            'sender_name' => ['required', 'string', 'max:255'],
            'mailinglist_id' => ['required'],
            'integration' => ['required', 'string', 'max:255'],
        ], $messages);

        if (SmsCampaign::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::where('plan_id', Auth::user()->plan)->first()->sms_automation) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access'
            ]);
        }

        if (strlen($request->sender_name) > 11) {
            // Handle the error: Input exceeds maximum length
            return back()->with([
                'type' => 'danger',
                'message' => 'Input exceeds maximum length of 11 characters.'
            ]);
            // You may redirect back to the form with an error message, or handle it according to your application logic
        }

        $sms_type = $request->sms_type;

        $contact = \App\Models\ListManagementContact::where(['list_management_id' => $request->mailinglist_id, 'subscribe' => true])->select('phone')
            ->get();

        if ($request->message_timing == 'Immediately') {
            $request->validate([
                'message' => ['required', 'string'],
            ]);
            if ($request->integration == "Multitexter") {
                $message = $this->sendMessageMultitexter($request);

                if ($message == true) {
                    $new_campaign = SmsCampaign::create([
                        'title' => $request->campaign_name,
                        'user_id' => Auth::user()->id,
                        'message' => $request->message,
                        'sender_name' => $request->sender_name,
                        'integration' => $request->integration,
                        'receivers' => $contact,
                        'sms_type' => $sms_type,
                        'status' => 'send',
                    ]);

                    $new_campaign->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    $new_campaign->save();

                    return back()->with([
                        'type' => 'success',
                        'message' => 'SMS Campaign Automation Created.'
                    ]);
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => $message
                    ]);
                }
            } elseif ($request->integration == "NigeriaBulkSms") {
                $message = $this->sendMessageNigeriaBulkSms($request);

                // if (str_contains($message, 'Message sent')) {
                if ($message == true) {
                    $new_campaign = SmsCampaign::create([
                        'title' => $request->campaign_name,
                        'user_id' => Auth::user()->id,
                        'message' => $request->message,
                        'sender_name' => $request->sender_name,
                        'integration' => $request->integration,
                        'receivers' => $contact,
                        'sms_type' => $sms_type,
                        'status' => 'send',
                    ]);

                    $new_campaign->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    $new_campaign->save();

                    return back()->with([
                        'type' => 'success',
                        'message' => 'SMS Campaign Automation Created.'
                    ]);
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => $message
                    ]);
                }
            } elseif ($request->integration == "Twillio") {
                $message = $this->sendMessageTwilio($request);

                if ($message == true ) {
                    $new_campaign = SmsCampaign::create([
                        'title' => $request->campaign_name,
                        'user_id' => Auth::user()->id,
                        'message' => $request->message,
                        'sender_name' => $request->sender_name,
                        'integration' => $request->integration,
                        'receivers' => $contact,
                        'sms_type' => $sms_type,
                        'status' => 'send',
                    ]);

                    $new_campaign->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    $new_campaign->save();

                    return back()->with([
                        'type' => 'success',
                        'message' => 'SMS Campaign Automation Created.'
                    ]);
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => $message
                    ]);
                }
            } elseif ($request->integration == "AWS") {
                $message = $this->sendMessageAWS($request);

                if ($message == true ) {
                    $new_campaign = SmsCampaign::create([
                        'title' => $request->campaign_name,
                        'user_id' => Auth::user()->id,
                        'message' => $request->message,
                        'sender_name' => $request->sender_name,
                        'integration' => $request->integration,
                        'receivers' => $contact,
                        'sms_type' => $sms_type,
                        'status' => 'send',
                    ]);

                    $new_campaign->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    $new_campaign->save();

                    return back()->with([
                        'type' => 'success',
                        'message' => 'SMS Campaign Automation Created.'
                    ]);
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => $message
                    ]);
                }
            } elseif ($request->integration == "InfoBip") {
                $message = $this->sendMessageInfoBip($request);

                if ($message == true ) {
                    $new_campaign = SmsCampaign::create([
                        'title' => $request->campaign_name,
                        'user_id' => Auth::user()->id,
                        'message' => $request->message,
                        'sender_name' => $request->sender_name,
                        'integration' => $request->integration,
                        'receivers' => $contact,
                        'sms_type' => $sms_type,
                        'status' => 'send',
                    ]);

                    $new_campaign->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    $new_campaign->save();

                    return back()->with([
                        'type' => 'success',
                        'message' => 'SMS Campaign Automation Created.'
                    ]);
                } else {
                    return back()->with([
                        'type' => 'danger',
                        'message' => $message
                    ]);
                }
            } else {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Integration service ongoing.'
                ]);
            }
        } elseif ($request->message_timing == 'Schedule') {
            $this->validate($request, [
                'message' => ['required', 'string'],
                'schedule_date' => ['required'],
                'schedule_time' => ['required'],
            ]);

            $new_campaign = SmsCampaign::create([
                'title' => $request->campaign_name,
                'user_id' => Auth::user()->id,
                'maillist_id' => $request->mailinglist_id,
                'message' => $request->message,
                'sender_name' => $request->sender_name,
                'integration' => $request->integration,
                'receivers' => $contact,
                'sms_type' => $sms_type,
                'status' => 'send',
            ]);

            $schedule_date = $request->schedule_date . ' ' . $request->schedule_time;
            // dd($request->schedule_date);
            $schedule_time = $schedule_date;

            $new_campaign->status = SmsCampaign::STATUS_SCHEDULED;
            $new_campaign->schedule_time = $schedule_time;


            if ($request->frequency_cycle == 'onetime') {
                // working with onetime schedule
                $new_campaign->schedule_type = SmsCampaign::TYPE_ONETIME;
            } else {
                $this->validate($request, [
                    'recurring_date' => ['required'],
                    'recurring_time' => ['required'],
                ]);
                // working with recurring schedule
                //if schedule time frequency is not one time then check frequency details
                $recurring_date = $request->recurring_date . ' ' . $request->recurring_time;
                $recurring_end = $recurring_date;

                $new_campaign->schedule_type = SmsCampaign::TYPE_RECURRING;
                $new_campaign->recurring_end = $recurring_end;

                if (isset($request->frequency_cycle)) {
                    if ($request->frequency_cycle != 'custom') {
                        $schedule_cycle = SmsCampaign::scheduleCycleValues();
                        $limits = $schedule_cycle[$request->frequency_cycle];
                        $new_campaign->frequency_cycle = $request->frequency_cycle;
                        $new_campaign->frequency_amount = $limits['frequency_amount'];
                        $new_campaign->frequency_unit = $limits['frequency_unit'];
                    } else {
                        $new_campaign->frequency_cycle = $request->frequency_cycle;
                        $new_campaign->frequency_amount = $request->frequency_amount;
                        $new_campaign->frequency_unit = $request->frequency_unit;
                    }
                }
            }

            //update cache
            //$total = 0;
            $new_campaign->cache = json_encode([
                'ContactCount' => $contact->count(),
                'DeliveredCount' => 0,
                'FailedDeliveredCount' => 0,
                'NotDeliveredCount' => 0,
            ]);
            //finally, store data and return response
            $camp = $new_campaign->save();

            // Now add the phone numbers with messages to queue that will be handled further
            foreach ($contact as $receiver) {
                \App\Models\SmsQueue::create([
                    'sms_campaign_id' => $new_campaign->id,
                    'phone_number' => $receiver->phone,
                    'status' => \App\Enums\SmsQueueStatus::WAITING
                ]);
            }

            return back()->with([
                'type' => 'success',
                'message' => 'SMS Campaign Automation Created.'
            ]);

            //return new \App\Http\Resources\SmsCampaingResource($new_campaign);
        } elseif ($request->message_timing == 'Series') {
            $request->validate([
                'date.*' => 'required|string',
                'series_message.*' => 'required',
            ]);

            $new_campaign = SmsCampaign::create([
                'title' => $request->campaign_name,
                'user_id' => Auth::user()->id,
                'maillist_id' => $request->mailinglist_id,
                'message' => $request->message,
                'sender_name' => $request->sender_name,
                'integration' => $request->integration,
                'receivers' => $contact,
                'sms_type' => $sms_type,
                'status' => 'scheduled',
            ]);

            foreach ($request->input('date') as $key => $value) {
                $series_sms = new SeriesSmsCampaign();
                $series_sms->sms_campaign_id = $new_campaign->id;
                $series_sms->user_id = Auth::user()->id;
                $series_sms->message = $request->series_message[$key];

                // Split the string by space to separate date/time and the rest
                $parts = explode(' ', $value);

                // Extract date and time from the first part
                $part1 = $parts[0]; // "2024-02-15"
                $part2 = $parts[1];

                if($part2 == 'ij')
                {
                    $series_sms->date = now();
                    $series_sms->day = 'Immediately Joined';
                } elseif($part2 == 'sdj'){
                    $series_sms->date = $part1;
                    $series_sms->day = 'Same Day Joined';
                } else {
                    $dateWithoutTimezone = preg_replace('/-\d+$/', '', $value);
                    $series_sms->date = $dateWithoutTimezone;
                    preg_match('/-(\d+)$/', $value, $matches);
                    $dayNumber = $matches[1];
                    $series_sms->day = $dayNumber;
                }
                $series_sms->save();
            }

            $new_campaign->schedule_type = 'series';

            $new_campaign->save();

            return back()->with([
                'type' => 'success',
                'message' => 'SMS Campaign Automation Created.'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Invalid sms type'
            ]);
        }
    }

    public function view_series_sms($sms_id)
    {
        $finder = decrypt($sms_id);

        $series = SeriesSmsCampaign::latest()->where('sms_campaign_id', $finder)->with('campaign')->get();

        return view('dashboard.sms.view_series', [
            'series' => $series
        ]);
    }

    public function update_series_sms($series_id, Request $request)
    {
        $finder = decrypt($series_id);

        $series = SeriesSmsCampaign::find($finder);

        // Split the string by space to separate date/time and the rest
        $parts = explode(' ', $request->date);

        // Extract date and time from the first part
        $part1 = $parts[0]; // "2024-02-15"
        $part2 = $parts[1];

        if($part2 == 'ij')
        {
            $series->update([
                'date' => now(),
                'day' => 'Immediately Joined',
                'message' => $request->message,
            ]);
        } elseif($part2 == 'sdj'){
            $series->update([
                'date' => $part1,
                'day' => 'Same Day Joined',
                'message' => $request->message,
            ]);
        } else {
            $dateWithoutTimezone = preg_replace('/-\d+$/', '', $request->date);

            preg_match('/-(\d+)$/', $request->date, $matches);
            $dayNumber = $matches[1];

            $series->update([
                'date' => $dateWithoutTimezone,
                'day' => $dayNumber,
                'message' => $request->message,
            ]);
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Sms series updated successfully.'
        ]);
    }

    public function action_series_sms($series_id)
    {
        $series = SeriesSmsCampaign::find(decrypt($series_id));

        $newAction = ($series->action == 'Play') ? 'Pause' : 'Play';

        $series->update([
            'action' => $newAction
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'SMS series ' . ($newAction == 'Pause' ? 'paused' : 'played') . ' successfully.'
        ]);
    }

    public function delete_series_sms($series_id)
    {
        $series = SeriesSmsCampaign::find(decrypt($series_id));

        $series->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Sms series deleted successfully.'
        ]);
    }

    public function action_sms($sms_id)
    {
        $sms = SmsCampaign::find(decrypt($sms_id));

        $newAction = ($sms->action == 'Play') ? 'Pause' : 'Play';

        $sms->update([
            'action' => $newAction
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'SMS campaign ' . ($newAction == 'Pause' ? 'paused' : 'played') . ' successfully.'
        ]);
    }

    public function sendMessageTwilio(Request $request)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $request->mailinglist_id)->select('phone', 'name')->get();

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $d = $contacts->toArray();

        $sid = $integration->sid;
        $auth_token = $integration->token;
        $from_number = $integration->from;
        $sender_name = $request->sender_name;
        $recipients = $d;

        foreach( $recipients as $value )
        {
            $sid = $sid; // Your Account SID from www.twilio.com/console
            $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
            $from_number = $from_number; // Valid Twilio number

            $client = new twilio($sid, $auth_token);

            $count = 0;

            try {

                $messageContent = str_replace('$name', $value['name'], $request->message);

                $count++;

                $client->messages->create(
                    $value['phone'],
                    [
                        'from' => $from_number,
                        'body' => $messageContent,
                    ]
                );

                $responseBody = true;

            } catch (Exception $e) {
                $responseBody = $e->getMessage();
            }
        }

        return $responseBody;
    }

    public function sendMessageMultitexter(Request $request)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $request->mailinglist_id)->select('phone', 'name')->get();

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $email = $integration->email;
        $password = $integration->password;
        $sender_name = $request->sender_name;
        $api_key = $integration->api_key;

        foreach($contacts as $contact)
        {
            try {
                $client = new Client(); //GuzzleHttp\Client
                $url = "https://app.multitexter.com/v2/app/sms";

                $messageContent = str_replace('$name', $contact->name, $request->message);

                $params = [
                    "email" => $email,
                    "password" => $password,
                    "sender_name" => $sender_name,
                    "message" => $messageContent,
                    "recipients" => $contact->phone
                ];

                $headers = [
                    'Authorization' => 'Bearer ' . $api_key
                ];

                $response = $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                ]);

                $statusCode = $response->getStatusCode();
                $responseBody = $response->getBody()->getContents();
                Log::info("Multitexter SMS sent. Status Code: $statusCode, Response: $responseBody");
            } catch (Exception $e) {
                $responseBody = $e->getMessage();
                Log::error("Error sending Multitexter SMS: " . $e->getMessage());
            }
        }

        return $responseBody;
    }

    public function sendMessageNigeriaBulkSms(Request $request)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $request->mailinglist_id)->select('phone', 'name')->get();

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $username = $integration->username;
        $password = $integration->password;
        $sender = $request->sender_name;

        foreach($contacts as $contact)
        {
            try {
                $messageContent = str_replace('$name', $contact->name, $request->message);

                // Separate multiple numbers by comma
                $mobiles = $contact->phone;

                // Set your domain's API URL
                $api_url = 'http://portal.nigeriabulksms.com/api/';

                //Create the message data
                $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $messageContent, 'mobiles' => $mobiles);

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

                // if (isset($result->status) && strtoupper($result->status) == 'OK') {
                //     // Message sent successfully, do anything here
                //     return 'Message sent at N' . $result->price;
                // } else if (isset($result->error)) {
                //     // Message failed, check reason.
                //     return 'Message failed - error: ' . $result->error;
                // } else {
                //     // Could not determine the message response.
                //     return 'Unable to process request';
                // }

                $responseBody = true;
            } catch (Exception $e) {
                $responseBody = $e->getMessage();
            }
        }

        return $responseBody;
    }

    public function sendMessageAWS(Request $request)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $request->mailinglist_id)->select('phone', 'name')->get();

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $key = $integration->key;
        $secret = $integration->secret;
        $sender = $request->sender_name;

        foreach($contacts as $contact)
        {
            try {
                $messageContent = str_replace('$name', $contact->name, $request->message);

                // Required variables to initialize SNS Client Object
                $params = [
                    'credentials' => [
                        'key' => $key,
                        'secret' => $secret
                    ],
                    'region' => 'us-east-1',
                    'version' => 'latest'
                ];

                $SnSclient = new SnsClient($params);

                // Basic Configuration of messages like SMS type, message, and phone number
                $args = [
                    'MessageAttributes' => [
                        'AWS.SNS.SMS.SenderID' => [
                            'DataType' => 'String',
                            'StringValue'=> $sender
                        ],
                        'AWS.SNS.SMS.SMSType' => [
                            'DataType' => 'String',
                            'StringValue'=> 'Transactional'
                        ]
                    ],
                    "Message" => $messageContent,
                    "PhoneNumber" => $contact->phone
                ];

                $result = $SnSclient->publish($args);

                $responseBody = true;
            } catch (Exception $e) {
                $responseBody = $e->getMessage();
            }
        }

        return $responseBody;
    }

    public function sendMessageInfoBip(Request $request)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $request->mailinglist_id)->select('phone', 'name')->get();

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $API_KEY = $integration->api_key;
        $BASE_URL = $integration->api_base_url;
        $SENDER = $request->sender_name;

        foreach($contacts as $contact)
        {
            try {
                $RECIPIENT = $contact->phone;

                $MESSAGE = str_replace('$name', $contact->name, $request->message);

                $data_json = '{
                    "messages": [
                        {
                        "destinations": [
                            {
                            "to": "'.$RECIPIENT.'"
                            }
                        ],
                        "from": "'.$SENDER.'",
                        "text": "'.$MESSAGE.'"
                        }
                    ]
                }';

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://'.$BASE_URL.'/sms/2/text/advanced',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $data_json,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: App '.$API_KEY,
                        'Content-Type: application/json',
                        'Accept: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $responseBody = true;
            } catch (Exception $e) {
                $responseBody = $e->getMessage();
            }
        }

        return $responseBody;
    }
}
