<?php

namespace App\Console\Commands;

use App\Models\SeriesSmsCampaign;
use App\Models\SmsCampaign;
use Aws\Sns\SnsClient;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Twilio\Rest\Client as twilio;

class SeriesSMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smsSeriesCampaign:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run SmS Series Campaign';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $series = SmsCampaign::where('schedule_type', 'series')->where('status', 'scheduled')->get();

        if($series->count() > 0) {
            foreach($series as $followup) {
                $ssc = SeriesSmsCampaign::where([
                    'sms_campaign_id' => $followup->id,
                    'date' => $current_date,
                ])->get();

                foreach($ssc as $sms)
                {
                    $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

                    // Check integration type and send SMS
                    switch ($smsCampaign->integration) {
                        case 'Multitexter':
                            $this->sendMessageMultitexter($sms);
                            break;
                        case 'NigeriaBulkSms':
                            $this->sendMessageNigeriaBulkSms($sms);
                            break;
                        case 'Twilio':
                            $this->sendMessageTwilio($sms);
                            break;
                        case 'AWS':
                            $this->sendMessageAWS($sms);
                            break;
                        case 'InfoBip':
                            $this->sendMessageInfoBip($sms);
                            break;
                    }
                }

                $smsSeries = SeriesSmsCampaign::where('sms_campaign_id', $followup->id)->get();

                foreach ($smsSeries as $sms) {
                    // Retrieve new contacts created after the SMS series was created
                    $newContacts = \App\Models\ListManagementContact::where('list_management_id', $sms->sms_campaign_id)
                        ->where('created_at', '>=', $sms->date) // Adjusted here
                        ->where('subscribe', true)
                        ->select('phone', 'name', 'created_at')
                        ->get();

                    foreach ($newContacts as $contact) {
                        $daysDifference = $contact->created_at->diffInDays($smsSeries[0]->date); // Calculate difference in days from the first day of the SMS series
                        // $indexToSend = min($daysDifference, count($smsSeries) - 1); // Ensure the index doesn't exceed the number of SMS series available
                        // $smsForDay = SeriesSmsCampaign::where([
                        //     'sms_campaign_id' => $sms->sms_campaign_id,
                        //     'day' => $indexToSend,
                        // ])->first();

                        $indexToSend = min($daysDifference, count($smsSeries)) - 1;
                        $smsForDay = $smsSeries[$indexToSend - 1];

                        if ($smsForDay) {
                            $this->sendSmsToContact($followup, $contact, $smsForDay);
                        }
                    }
                }
            }
        }

        return Command::SUCCESS;
    }

    private function sendSmsToContact($smsCampaign, $contact, $sms)
    {
        $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

        // Check integration type and send SMS
        switch ($smsCampaign->integration) {
            case 'Multitexter':
                $email = $integration->email;
                $password = $integration->password;
                $sender_name = $smsCampaign->sender_name;
                $api_key = $integration->api_key;

                try {
                    $client = new Client(); //GuzzleHttp\Client
                    $url = "https://app.multitexter.com/v2/app/sms";

                    $messageContent = str_replace('$name', $contact->name, $sms->message);

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

                    // $responseBody = json_decode($response->getBody());
                    // Log the response status code and body
                    $statusCode = $response->getStatusCode();
                    $responseBody = $response->getBody()->getContents();
                    // Log::info("Multitexter SMS sent. Status Code: $statusCode, Response: $responseBody");
                    $sms->DeliveredCount = $sms->DeliveredCount + 1;
                } catch (Exception $e) {
                    $sms->FailedDeliveredCount = $sms->FailedDeliveredCount + 1;
                    // Log the exception
                    // Log::error("Error sending Multitexter SMS: " . $e->getMessage());
                }
                $sms->ContactCount = $sms->ContactCount + $contact->count();
                $sms->NotDeliveredCount = 0;
                $sms->save();
                break;
            case 'NigeriaBulkSms':
                $username = $integration->username;
                $password = $integration->password;
                $sender = $smsCampaign->sender_name;
                try {
                    $messageContent = str_replace('$name', $contact->name, $sms->message);

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

                    if (isset($result->status) && strtoupper($result->status) == 'OK') {
                        // Message sent successfully, do anything here
                        // return 'Message sent at N' . $result->price;
                        $sms->DeliveredCount = $sms->DeliveredCount + 1;
                    } else if (isset($result->error)) {
                        // Message failed, check reason.
                        // return 'Message failed - error: ' . $result->error;
                        $sms->FailedDeliveredCount =  $sms->FailedDeliveredCount + 1;
                    } else {
                        // Could not determine the message response.
                        return 'Unable to process request';
                        $sms->NotDeliveredCount = $sms->NotDeliveredCount + 1;
                    }

                } catch (Exception $e) {
                    // $responseBody = $e;
                    $sms->NotDeliveredCount = $sms->NotDeliveredCount + 1;
                }

                $sms->ContactCount = $sms->ContactCount + $contact->count();
                $sms->save();
                break;
            case 'Twilio':
                $sid = $integration->sid;
                $auth_token = $integration->token;
                $from_number = $integration->from;
                $sender_name = $smsCampaign->sender_name;

                try {
                    $sid = $sid; // Your Account SID from www.twilio.com/console
                    $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
                    $from_number = $from_number; // Valid Twilio number

                    $client = new twilio($sid, $auth_token);

                    $messageContent = str_replace('$name', $contact->name, $sms->message);

                    $client->messages->create(
                        $contact->phone,
                        [
                            'from' => $from_number,
                            'body' => $messageContent,
                        ]
                    );
                    $sms->ContactCount = $sms->ContactCount + $contact->count();
                    $sms->DeliveredCount = $sms->DeliveredCount + 1;
                    $sms->NotDeliveredCount = 0;


                } catch(Exception $e) {
                    $sms->FailedDeliveredCount = $sms->FailedDeliveredCount + 1;
                    // return $e->getMessage()
                }
                $sms->save();
                break;
            case 'AWS':
                $key = $integration->key;
                $secret = $integration->secret;
                $sender = $smsCampaign->sender_name;

                try {
                    $messageContent = str_replace('$name', $contact->name, $sms->message);

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
                    // return $result;

                    $sms->ContactCount = $sms->ContactCount + $contact->count();
                    $sms->DeliveredCount = $sms->DeliveredCount + 1;
                    $sms->NotDeliveredCount = 0;

                } catch (Exception $e) {
                    $sms->FailedDeliveredCount = $sms->FailedDeliveredCount + 1;
                    // $responseBody = $e;
                }
                $sms->save();
                break;
            case 'InfoBip':
                $API_KEY = $integration->api_key;
                $BASE_URL = $integration->api_base_url;
                $SENDER = $smsCampaign->sender_name;

                try {
                    $RECIPIENT = $contact->phone;

                    $MESSAGE = str_replace('$name', $contact->name, $sms->message);

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

                    $sms->ContactCount = $sms->ContactCount + $contact->count();
                    $sms->DeliveredCount = $sms->DeliveredCount + 1;
                    $sms->NotDeliveredCount = 0;

                } catch (Exception $e) {
                    $sms->FailedDeliveredCount =  $sms->FailedDeliveredCount + 1;
                    // $responseBody = $e;
                }

                $sms->save();
                break;
        }
    }

    public function sendMessageTwilio($sms)
    {
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

        $d = $contacts->toArray();

        $sid = $integration->sid;
        $auth_token = $integration->token;
        $from_number = $integration->from;
        $sender_name = $smsCampaign->sender_name;
        $recipients = $d;

        try {
            $sid = $sid; // Your Account SID from www.twilio.com/console
            $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
            $from_number = $from_number; // Valid Twilio number

            $client = new twilio($sid, $auth_token);

            $count = 0;

            foreach( $recipients as $value )
            {
                $messageContent = str_replace('$name', $value['name'], $sms->message);

                $count++;

                $client->messages->create(
                    $value['phone'],
                    [
                        'from' => $from_number,
                        'body' => $messageContent,
                    ]
                );
            }

            $sms->ContactCount = $sms->ContactCount + $contacts->count();
            $sms->DeliveredCount = $sms->DeliveredCount + $contacts->count();
            $sms->FailedDeliveredCount = 0;
            $sms->NotDeliveredCount = 0;

            $sms->save();

            return true;

        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendMessageMultitexter($sms)
    {
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

        $email = $integration->email;
        $password = $integration->password;
        $sender_name = $smsCampaign->sender_name;
        $api_key = $integration->api_key;

        foreach($contacts as $contact)
        {
            try {
                $client = new Client(); //GuzzleHttp\Client
                $url = "https://app.multitexter.com/v2/app/sms";

                $messageContent = str_replace('$name', $contact->name, $sms->message);

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

                // $responseBody = json_decode($response->getBody());
                // Log the response status code and body
                $statusCode = $response->getStatusCode();
                $responseBody = $response->getBody()->getContents();
                Log::info("Multitexter SMS sent. Status Code: $statusCode, Response: $responseBody");
                $sms->DeliveredCount = $sms->DeliveredCount + 1;
            } catch (Exception $e) {
                $sms->FailedDeliveredCount = $sms->FailedDeliveredCount + 1;
                // Log the exception
                Log::error("Error sending Multitexter SMS: " . $e->getMessage());
            }
        }
        $sms->ContactCount = $sms->ContactCount + $contact->count();
        $sms->NotDeliveredCount = 0;
        $sms->save();
    }

    public function sendMessageNigeriaBulkSms($sms)
    {
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

        $username = $integration->username;
        $password = $integration->password;
        $sender = $smsCampaign->sender_name;

        foreach($contacts as $contact)
        {
            try {
            $messageContent = str_replace('$name', $contact->name, $sms->message);

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

            if (isset($result->status) && strtoupper($result->status) == 'OK') {
                // Message sent successfully, do anything here
                // return 'Message sent at N' . $result->price;
                $sms->DeliveredCount = $sms->DeliveredCount + 1;
            } else if (isset($result->error)) {
                // Message failed, check reason.
                // return 'Message failed - error: ' . $result->error;
                $sms->FailedDeliveredCount =  $sms->FailedDeliveredCount + 1;
            } else {
                // Could not determine the message response.
                return 'Unable to process request';
                $sms->NotDeliveredCount = $sms->NotDeliveredCount + 1;
            }

            } catch (Exception $e) {
                // $responseBody = $e;
                $sms->NotDeliveredCount = $sms->NotDeliveredCount + 1;
            }

        }
        $sms->ContactCount = $sms->ContactCount + $contacts->count();
        $sms->save();
    }

    public function sendMessageAWS($sms)
    {
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

        $key = $integration->key;
        $secret = $integration->secret;
        $sender = $smsCampaign->sender_name;

        try {
            foreach($contacts as $contact)
            {
                $messageContent = str_replace('$name', $contact->name, $sms->message);

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
                // return $result;
            }

            $sms->ContactCount = $sms->ContactCount + $contacts->count();
            $sms->DeliveredCount = $sms->DeliveredCount + $contacts->count();
            $sms->FailedDeliveredCount = 0;
            $sms->NotDeliveredCount = 0;

            $sms->save();

            $responseBody = true;
        } catch (Exception $e) {
            $responseBody = $e;
        }

        // return $responseBody;

    }

    public function sendMessageInfoBip($sms)
    {
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

        $API_KEY = $integration->api_key;
        $BASE_URL = $integration->api_base_url;
        $SENDER = $smsCampaign->sender_name;

        try {
            foreach($contacts as $contact)
            {
                $RECIPIENT = $contact->phone;

                $MESSAGE = str_replace('$name', $contact->name, $sms->message);

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
            }

            $sms->ContactCount = $sms->ContactCount + $contacts->count();
            $sms->DeliveredCount = $sms->DeliveredCount + $contacts->count();
            $sms->FailedDeliveredCount = 0;
            $sms->NotDeliveredCount = 0;

            $sms->save();

            $responseBody = true;
        } catch (Exception $e) {
            $responseBody = $e;
        }

        return $responseBody;
    }
}
