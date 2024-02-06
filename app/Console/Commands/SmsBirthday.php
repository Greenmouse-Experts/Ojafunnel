<?php

namespace App\Console\Commands;

use App\Models\BirthdayAutomation;
use App\Models\BirthdayContact;
use App\Models\Integration;
use App\Models\ListManagementContact;
use Aws\Sns\SnsClient;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Twilio\Rest\Client as twilio;

class SmsBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smsBirthday:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $birthday = BirthdayAutomation::where('action', 'Play')->where('start_date', '<=', Carbon::today()->toDateString())
            ->where('end_date', '>=', Carbon::today()->toDateString())
            ->get();

        if ($birthday->isEmpty()) {
            return Command::SUCCESS;
        }

        foreach ($birthday as $key => $ba) {
            if ($ba->sms_type == 'birthday') {
                $birthdayContactList = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->select('phone')->get();
                // \Log::info($birthdayContactList);
                $birthdayContactLists = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->select('phone', 'name')->get();

                if ($birthdayContactList->isEmpty() || $birthdayContactLists->isEmpty()) {
                    return;
                }

                if ($ba->automation == 'SMS & WhatsApp Automation') {
                    $integration = Integration::find($ba->integration);
                    // \Log::info($integration->type);
                    if ($integration->type == "Multitexter") {
                        $d = $birthdayContactList->toArray();
                        //  \Log::info($d);

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // \Log::info($datum);

                        $email = $integration->email;
                        $password = $integration->password;
                        $message = $ba->message;
                        $sender_name = $ba->sender_name;
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

                            $response = $client->request('POST', $url, [
                                'json' => $params,
                                'headers' => $headers,
                            ]);

                            $responseBody = json_decode($response->getBody());
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }

                        // return $responseBody;
                    }

                    if ($integration->type == "NigeriaBulkSms") {
                        $d = $birthdayContactList->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // Initialize variables ( set your variables here )
                        $username = $integration->username;
                        $password = $integration->password;
                        $sender = $ba->sender_name;
                        $message = $ba->message;
                        $recipients = $datum;

                        try {
                            /*
                            Sending messages using our API
                            Requirements - PHP, cURL (enabled) function
                            */

                            // Separate multiple numbers by comma
                            $mobiles = $recipients;

                            // Set your domain's API URL
                            $api_url = 'http://portal.nigeriabulksms.com/api/';


                            // Create the message data
                            $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $message, 'mobiles' => $mobiles);

                            // URL encode the message data
                            $data = http_build_query($data);

                            // Send the message
                            $ch = curl_init(); // Initialize a cURL connection

                            curl_setopt($ch, CURLOPT_URL, $api_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                            $result = curl_exec($ch);
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }
                    }

                    if($integration->type == 'Twillio')
                    {
                        $d = $birthdayContactList->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        $sid = $integration->sid;
                        $auth_token = $integration->token;
                        $from_number = $integration->from;
                        $message = $ba->message;
                        $sender_name = $ba->sender_name;
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

                        } catch(Exception $e) {
                            $responseBody = $e->getMessage();
                        }
                    }

                    if($integration->type == 'InfoBip')
                    {
                        $API_KEY = $integration->api_key;
                        $BASE_URL = $integration->api_base_url;
                        $SENDER = $ba->sender_name;;

                        try {
                            foreach($birthdayContactLists as $contact)
                            {
                                $RECIPIENT = $contact->phone;

                                $MESSAGE = str_replace('$name', $contact->name, $ba->message);

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

                            $responseBody = true;
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }

                        return $responseBody;
                    }

                    if($integration->type == 'AWS')
                    {
                        $key = $integration->key;
                        $secret = $integration->secret;
                        $sender = $ba->sender_name;

                        try {
                            foreach($birthdayContactLists as $contact)
                            {
                                $messageContent = str_replace('$name', $contact->name, $ba->message);

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

                            $responseBody = true;
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }

                        return $responseBody;
                    }
                }
            }

            if ($ba->sms_type == 'anniversary') {
                $birthdayContactList = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('anniversary', '=', date('m'))->whereDay('anniversary', '=', date('d'))->select('phone')->get();

                $birthdayContactLists = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('anniversary', '=', date('m'))->whereDay('anniversary', '=', date('d'))->select('phone', 'name')->get();

                if ($birthdayContactList->isEmpty() || $birthdayContactLists->isEmpty()) {
                    return;
                }

                if ($ba->automation == 'SMS & WhatsApp Automation') {
                    $integration = Integration::find($ba->integration);
                    // \Log::info($integration->type);
                    if ($integration->type == "Multitexter") {
                        $d = $birthdayContactList->toArray();
                        //  \Log::info($d);

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // \Log::info($datum);

                        $email = $integration->email;
                        $password = $integration->password;
                        $message = $ba->message;
                        $sender_name = $ba->sender_name;
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

                        // return $responseBody;
                    }

                    if ($integration->type == "NigeriaBulkSms") {
                        $d = $birthdayContactList->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // Initialize variables ( set your variables here )
                        $username = $integration->username;
                        $password = $integration->password;
                        $sender = $ba->sender_name;
                        $message = $ba->message;
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


                            // Create the message data
                            $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $message, 'mobiles' => $mobiles);

                            // URL encode the message data
                            $data = http_build_query($data);

                            // Send the message
                            $ch = curl_init(); // Initialize a cURL connection

                            curl_setopt($ch, CURLOPT_URL, $api_url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                            $result = curl_exec($ch);
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }
                    }

                    if($integration->type == 'Twillio')
                    {
                        $d = $birthdayContactList->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        $sid = $integration->sid;
                        $auth_token = $integration->token;
                        $from_number = $integration->from;
                        $message = $ba->message;
                        $sender_name = $ba->sender_name;
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

                        } catch(Exception $e) {
                            $responseBody = $e->getMessage();
                        }
                    }

                    if($integration->type == 'InfoBip')
                    {
                        $API_KEY = $integration->api_key;
                        $BASE_URL = $integration->api_base_url;
                        $SENDER = $ba->sender_name;;

                        try {
                            foreach($birthdayContactLists as $contact)
                            {
                                $RECIPIENT = $contact->phone;

                                $MESSAGE = str_replace('$name', $contact->name, $ba->message);

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

                            $responseBody = true;
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }

                        return $responseBody;
                    }

                    if($integration->type == 'AWS')
                    {
                        $key = $integration->key;
                        $secret = $integration->secret;
                        $sender = $ba->sender_name;

                        try {
                            foreach($birthdayContactLists as $contact)
                            {
                                $messageContent = str_replace('$name', $contact->name, $ba->message);

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

                            $responseBody = true;
                        } catch (Exception $e) {
                            $responseBody = $e;
                        }

                        return $responseBody;
                    }
                }

            }
        }

        return Command::SUCCESS;
    }



}
