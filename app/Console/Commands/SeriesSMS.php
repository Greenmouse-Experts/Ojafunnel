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
                    'time' => $current_time
                ])->get();

                // Log::info($ssc);

                foreach($ssc as $sms)
                {
                    $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

                    if ($smsCampaign->integration == "Multitexter")
                    {
                        $this->sendMessageMultitexter($sms);
                    }

                    if ($smsCampaign->integration == "NigeriaBulkSms")
                    {
                       $this->sendMessageNigeriaBulkSms($sms);
                    }

                    if($smsCampaign->integration == 'Twillio')
                    {
                        $this->sendMessageTwilio($sms);
                    }

                    if($smsCampaign->integration == 'AWS')
                    {
                        $this->sendMessageAWS($sms);
                    }

                    if($smsCampaign->integration == 'InfoBip')
                    {
                        $this->sendMessageInfoBip($sms);
                    }
                }

            }
        }

        return Command::SUCCESS;
    }

    public function sendMessageTwilio($sms)
    {
        $contains = Str::contains($sms->message, '$name');
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        if($contains)
        {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone', 'name')->get();

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

        } else {

            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $d = $contacts->toArray();

            foreach ($d as $val) {
                $str = implode(',', $val);
                $data[] = $str;
            }
            $datum = implode(',', $data);

            $sid = $integration->sid;
            $auth_token = $integration->token;
            $from_number = $integration->from;
            $message = $sms->message;
            $sender_name = $smsCampaign->sender_name;
            $recipients = explode(',', $datum);

            try {
                $sid = $sid; // Your Account SID from www.twilio.com/console
                $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
                $from_number = $from_number; // Valid Twilio number

                $client = new twilio($sid, $auth_token);

                $count = 0;

                foreach( $recipients as $number )
                {
                    $count++;

                    $client->messages->create(
                        $number,
                        [
                            'from' => $from_number,
                            'body' => $message,
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
    }

    public function sendMessageMultitexter($sms)
    {
        $contains = Str::contains($sms->message, '$name');
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        if($contains)
        {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone', 'name')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $email = $integration->email;
            $password = $integration->password;
            $sender_name = $smsCampaign->sender_name;
            $api_key = $integration->api_key;

            try {
                foreach($contacts as $contact)
                {
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

                    $client->request('POST', $url, [
                        'json' => $params,
                        'headers' => $headers,
                    ]);
                }
                $sms->ContactCount = $sms->ContactCount + $contacts->count();
                $sms->DeliveredCount = $sms->DeliveredCount + $contacts->count();
                $sms->FailedDeliveredCount = 0;
                $sms->NotDeliveredCount = 0;

                $sms->save();
                // $responseBody = json_decode($response->getBody());
                $responseBody = true;
            } catch (Exception $e) {
                $responseBody = $e;
            }

            return $responseBody;

        } else {

            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $d = $contacts->toArray();

            foreach ($d as $val) {
                $str = implode(',', $val);
                $data[] = $str;
            }
            $datum = implode(',', $data);

            $email = $integration->email;
            $password = $integration->password;
            $message = $sms->message;
            $sender_name = $smsCampaign->sender_name;
            $recipients = $datum;
            $api_key = $integration->api_key;

            try {
                $client = new Client(); //GuzzleHttp\Client
                $url = "https://app.multitexter.com/v2/app/sms";

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

                $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                ]);

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

    public function sendMessageNigeriaBulkSms($sms)
    {
        $contains = Str::contains($sms->message, '$name');
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        if($contains)
        {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone', 'name')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $username = $integration->username;
            $password = $integration->password;
            $sender = $smsCampaign->sender_name;

            try {
                foreach($contacts as $contact)
                {
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

                }

                $sms->ContactCount = $sms->ContactCount + $contacts->count();
                $sms->DeliveredCount = $sms->DeliveredCount + $contacts->count();
                $sms->FailedDeliveredCount = 0;
                $sms->NotDeliveredCount = 0;

                $sms->save();

                $responseBody = true;
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
            } catch (Exception $e) {
                $responseBody = $e;
            }

            return $responseBody;

        } else {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $d = $contacts->toArray();

            foreach ($d as $val) {
                $str = implode(',', $val);
                $data[] = $str;
            }
            $datum = implode(',', $data);

            // Initialize variables ( set your variables here )
            $username = $integration->username;
            $password = $integration->password;
            $sender = $smsCampaign->sender_name;
            $message = $sms->message;
            $recipients = $datum;

            try {
                // Separate multiple numbers by comma
                $mobiles = $recipients;

                // Set your domain's API URL
                $api_url = 'http://portal.nigeriabulksms.com/api/';

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

    public function sendMessageAWS($sms)
    {
        $contains = Str::contains($sms->message, '$name');
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        if($contains)
        {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone', 'name')->get();

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

        } else {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $key = $integration->key;
            $secret = $integration->secret;
            $sender = $smsCampaign->sender_name;
            $message = $sms->message;

            try {
                foreach($contacts as $contact)
                {
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
                        "Message" => $message,
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

            return $responseBody;
        }
    }

    public function sendMessageInfoBip($sms)
    {
        $contains = Str::contains($sms->message, '$name');
        $smsCampaign = SmsCampaign::find($sms->sms_campaign_id);

        if($contains)
        {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone', 'name')->get();

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

        } else {
            $contacts = \App\Models\ListManagementContact::where('list_management_id', $smsCampaign->maillist_id)->select('phone')->get();

            $integration = \App\Models\Integration::where('user_id', $smsCampaign->user_id)->where('type', $smsCampaign->integration)->first();

            $API_KEY = $integration->api_key;
            $BASE_URL = $integration->api_base_url;
            $SENDER = $smsCampaign->sender_name;

            try {
                foreach($contacts as $contact)
                {
                    $RECIPIENT = $contact->phone;

                    $MESSAGE = $sms->message;

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
}
