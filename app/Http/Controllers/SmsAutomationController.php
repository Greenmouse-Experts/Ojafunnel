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

        // if ($request->mailinglist_id == null and $request->contacts !== null) {
        //     //Validate Request
        //     $this->validate($request, [
        //         'campaign_name' => ['required', 'string', 'max:255'],
        //         'sender_name' => ['required', 'string', 'max:255'],
        //         'message' => ['required', 'string', 'max:255'],
        //         'contacts' => ['required', 'string', 'max:255'],
        //         'optout_message' => ['required', 'string', 'max:255'],
        //         // 'message_timimg' => ['required', 'string', 'max:255'],
        //         'integration' => ['required', 'string', 'max:255'],
        //     ]);

        //     if ($request->message_timing == "Schedule") {
        //         $this->validate($request, [
        //             'schedule_date' => ['required', 'string', 'max:255'],
        //             'schedule_time' => ['required', 'string', 'max:255'],
        //         ]);
        //     }

        //     if ($request->integration == "Twilio") {
        //         $message = $this->sendMessageTwilio($request);

        //         dd($message);
        //     } elseif ($request->integration == "Multitexter") {
        //         try {
        //             $file = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $request->contacts));

        //             foreach ($file as $key => $escapedItem) {
        //                 $contacts = preg_replace('/\s+/', '', $escapedItem);
        //             }

        //             $data = implode(',', $contacts);

        //             $message = $this->sendMessageMultitexter($request, $data);

        //             SmsAutomation::create([
        //                 'user_id' => Auth::user()->id,
        //                 'mailinglist_id' => $request->mailinglist_id,
        //                 'integration' => $request->integration,
        //                 'campaign_name' => ucfirst($request->campaign_name),
        //                 'sms_sent' => count($contacts),
        //                 'delivered' => count($contacts),
        //                 'senders_name' => ucfirst($request->sender_name),
        //                 'message' => $request->message,
        //                 'contacts' => $request->contacts,
        //                 'optout_message' => $request->optout_message,
        //                 'message_timimg' => $request->message_timimg,
        //                 'schedule_date' => $request->schedule_date,
        //                 'schedule_time' => $request->schedule_time,
        //             ]);

        //             return redirect()->route('user.sms.automation', Auth::user()->username)->with([
        //                 'type' => 'success',
        //                 'message' => $message->msg
        //             ]);
        //         } catch (Exception $e) {
        //             $data = "Contact format invalid";
        //         }

        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => $data
        //         ]);
        //     } elseif ($request->integration == "NigeriaBulkSms") {
        //         try {
        //             $file = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $request->contacts));

        //             foreach ($file as $key => $escapedItem) {
        //                 $contacts = preg_replace('/\s+/', '', $escapedItem);
        //             }

        //             $data = implode(',', $contacts);

        //             $message = $this->sendMessageNigeriaBulkSms($request, $data);

        //             if(str_contains($message, 'Message sent'))
        //             {
        //                 SmsAutomation::create([
        //                     'user_id' => Auth::user()->id,
        //                     'mailinglist_id' => $request->mailinglist_id,
        //                     'integration' => $request->integration,
        //                     'campaign_name' => ucfirst($request->campaign_name),
        //                     'sms_sent' => count($contacts),
        //                     'delivered' => count($contacts),
        //                     'senders_name' => ucfirst($request->sender_name),
        //                     'message' => $request->message,
        //                     'contacts' => $request->contacts,
        //                     'optout_message' => $request->optout_message,
        //                     'message_timimg' => $request->message_timimg,
        //                     'schedule_date' => $request->schedule_date,
        //                     'schedule_time' => $request->schedule_time,
        //                 ]);

        //                 return redirect()->route('user.sms.automation', Auth::user()->username)->with([
        //                     'type' => 'success',
        //                     'message' => $message
        //                 ]);
        //             } else {
        //                 return back()->with([
        //                     'type' => 'danger',
        //                     'message' => $message
        //                 ]);
        //             }
        //         } catch (Exception $e) {
        //             $data = "Contact format invalid";
        //         }

        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => $data
        //         ]);
        //     } else {
        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => 'Integration service ongoing.'
        //         ]);
        //     }
        // } elseif ($request->contacts == null and $request->mailinglist_id !== null) {
        //     //Validate Request
        //     $this->validate($request, [
        //         'campaign_name' => ['required', 'string', 'max:255'],
        //         'sender_name' => ['required', 'string', 'max:255'],
        //         'message' => ['required', 'string', 'max:255'],
        //         'mailinglist_id' => ['required', 'string', 'max:255'],
        //         'optout_message' => ['required', 'string', 'max:255'],
        //         'message_timimg' => ['required', 'string', 'max:255'],
        //         'integration' => ['required', 'string', 'max:255'],
        //     ]);

        //     if ($request->message_timing == "Schedule") {
        //         $this->validate($request, [
        //             'schedule_date' => ['required', 'string', 'max:255'],
        //             'schedule_time' => ['required', 'string', 'max:255'],
        //         ]);
        //     }

        //     if ($request->integration == "Multitexter") {
        //         $data = "No Contact";

        //         $message = $this->sendMessageMultitexter($request, $data);

        //         $maillist = Mailinglist::findorfail($request->mailinglist_id);

        //         SmsAutomation::create([
        //             'user_id' => Auth::user()->id,
        //             'mailinglist_id' => $request->mailinglist_id,
        //             'integration' => $request->integration,
        //             'campaign_name' => ucfirst($request->campaign_name),
        //             'sms_sent' => $maillist->no_of_contacts,
        //             'delivered' => $maillist->no_of_contacts,
        //             'senders_name' => ucfirst($request->sender_name),
        //             'message' => $request->message,
        //             'contacts' => $request->contacts,
        //             'optout_message' => $request->optout_message,
        //             'message_timimg' => $request->message_timimg,
        //             'schedule_date' => $request->schedule_date,
        //             'schedule_time' => $request->schedule_time,
        //         ]);

        //         return redirect()->route('user.sms.automation', Auth::user()->username)->with([
        //             'type' => 'success',
        //             'message' => $message->msg
        //         ]);
        //     } elseif ($request->integration == "NigeriaBulkSms") {
        //         $data = "No Contact";

        //         $message = $this->sendMessageNigeriaBulkSms($request, $data);

        //         $maillist = Mailinglist::findorfail($request->mailinglist_id);

        //         if(str_contains($message, 'Message sent'))
        //         {
        //             SmsAutomation::create([
        //                 'user_id' => Auth::user()->id,
        //                 'mailinglist_id' => $request->mailinglist_id,
        //                 'integration' => $request->integration,
        //                 'campaign_name' => ucfirst($request->campaign_name),
        //                 'sms_sent' => $maillist->no_of_contacts,
        //                 'delivered' => $maillist->no_of_contacts,
        //                 'senders_name' => ucfirst($request->sender_name),
        //                 'message' => $request->message,
        //                 'contacts' => $request->contacts,
        //                 'optout_message' => $request->optout_message,
        //                 'message_timimg' => $request->message_timimg,
        //                 'schedule_date' => $request->schedule_date,
        //                 'schedule_time' => $request->schedule_time,
        //             ]);

        //             return redirect()->route('user.sms.automation', Auth::user()->username)->with([
        //                 'type' => 'success',
        //                 'message' => $message
        //             ]);
        //         } else {
        //             return back()->with([
        //                 'type' => 'danger',
        //                 'message' => $message
        //             ]);
        //         }
        //     } else {
        //         return back()->with([
        //             'type' => 'danger',
        //             'message' => 'Integration service ongoing.'
        //         ]);
        //     }
        // } else {
        //     return back()->with([
        //         'type' => 'danger',
        //         'message' => 'Please check your fields and try again!'
        //     ]);
        // }


        $this->validate($request, [
            'campaign_name' => ['required', 'string', 'max:255'],
            'sender_name' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            //'mailinglist_id' => ['required', 'array',],
            //'optout_message' => ['required', 'string', 'max:255'],
            // 'message_timimg' => ['required', 'string', 'max:255'],
            'integration' => ['required', 'string', 'max:255'],
        ]);

        $sms_type = $request->sms_type;

        $contact = \App\Models\ContactNumber::where('contact_list_id', $request->mailinglist_id)->select('phone_number')
            ->get();

        if ($request->message_timimg == 'Immediately') {
            if ($request->integration == "Multitexter") 
            {
                $message = $this->sendMessageMultitexter($request);

                if(str_contains($message->msg, 'Message has been sent'))
                {   
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
            } elseif ($request->integration == "NigeriaBulkSms") 
            {
                $message = $this->sendMessageNigeriaBulkSms($request);

                if(str_contains($message, 'Message sent'))
                {   
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
        }
        if ($request->message_timimg == 'Schedule') 
        {
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

            $schedule_date = $request->schedule_date . ' ' . $request->schedule_time;
            //dd($schedule_date);
            $schedule_time = $schedule_date;

            $new_campaign->status = SmsCampaign::STATUS_SCHEDULED;
            $new_campaign->schedule_time = $schedule_time;


            if ($request->frequency_cycle == 'onetime') {
                // working with onetime schedule
                $new_campaign->schedule_type = SmsCampaign::TYPE_ONETIME;
            } else {
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
            //dd($request->hasFile('mms_file'));
            if ($sms_type == 'whatsapp' && $request->hasFile('mms_file')) {
                $new_campaign->media_url = Tool::uploadImage($request->file('mms_file'));
            }

            //finally, store data and return response
            $camp = $new_campaign->save();


            //dd($contact);
            //$receivers = implode(';', $contact);

            // Need to validate specified phone numbers

            //dd($receivers);
            //$receivers = implode(';', $request->receivers);

            // Now add the phone numbers with messages to queue that will be handled further
            foreach ($contact as $receiver) {
                \App\Models\SmsQueue::create([
                    'sms_campaign_id' => $new_campaign->id,
                    'phone_number' => $receiver->phone_number,
                    'status' => \App\Enums\SmsQueueStatus::WAITING
                ]);
            }

            return back()->with([
                'type' => 'success',
                'message' => 'SMS Campaign Automation Created.'
            ]);

            //return new \App\Http\Resources\SmsCampaingResource($new_campaign);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Invalid sms type'
            ]);
        }
    }

    public function sendMessageTwilio(Request $request)
    {
        
    }

    public function sendMessageMultitexter(Request $request)
    {
        $contacts = ContactNumber::where('contact_list_id', $request->mailinglist_id)->get('phone_number');

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $d = $contacts->toArray();

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

    public function sendMessageNigeriaBulkSms(Request $request)
    {
        $contacts = ContactNumber::where('contact_list_id', $request->mailinglist_id)->get('phone_number');

        $integration = Integration::where('user_id', Auth::user()->id)->where('type', $request->integration)->first();

        $d = $contacts->toArray();

        foreach ($d as $val) {
            $str = implode(',', $val);
            $data[] = $str;
        }
        $datum = implode(',', $data);

        // Initialize variables ( set your variables here )
        $username = $integration->username;
        $password = $integration->password;
        $sender = $request->sender_name;
        $message = $request->message;
        $recipients = $datum;

        try {
            /*
            Sending messages using our API
            Requirements - PHP, cURL (enabled) function
            */

            // Separate multiple numbers by comma

            $mobiles = $recipients;

            // Set your domain's API URL

            $api_url = 'http://portal.nigeriabulksms.com/api/?';


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
