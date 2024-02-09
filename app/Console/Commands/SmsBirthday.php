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
use Illuminate\Support\Facades\Log;
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
        $date = Carbon::now();
        $currentDate = Carbon::today()->toDateString();

        $birthday = BirthdayAutomation::where('automation', 'SMS & WhatsApp Automation')
            ->where('action', 'Play')
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->get();

        // Log::info($birthday);

        if ($birthday->isEmpty()) {
            return Command::SUCCESS;
        }

        $delay = mt_rand(10, 20);

        foreach ($birthday as $key => $ba) {
            if ($ba->sms_type == 'birthday') {
                $birthdayContactLists = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->select('phone', 'name')->get();

                if ($birthdayContactLists->isEmpty()) {
                    return;
                }

                $integration = Integration::find($ba->integration);

                if ($integration->type == "Multitexter") {
                    $email = $integration->email;
                    $password = $integration->password;
                    $sender_name = $ba->sender_name;
                    $api_key = $integration->api_key;

                    foreach($birthdayContactLists as $contact)
                    {
                        $recipients = $contact->phone;
                        $message = str_replace('$name', $contact->name, $ba->message);

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

                            // Log the response status code and body
                            $statusCode = $response->getStatusCode();
                            $responseBody = $response->getBody()->getContents();
                            Log::info("Multitexter SMS sent. Status Code: $statusCode, Response: $responseBody");
                        } catch (Exception $e) {
                            // Log the exception
                            Log::error("Error sending Multitexter SMS: " . $e->getMessage());
                        }

                        // Introduce a delay if necessary
                        sleep($delay);
                    }
                }

                if ($integration->type == "NigeriaBulkSms") {
                    // Initialize variables ( set your variables here )
                    $username = $integration->username;
                    $password = $integration->password;
                    $sender = $ba->sender_name;

                    foreach($birthdayContactLists as $contact)
                    {
                        $mobiles = $contact->phone;

                        $MESSAGE = str_replace('$name', $contact->name, $ba->message);

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
                            $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $MESSAGE, 'mobiles' => $mobiles);

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

                        // Introduce a delay if necessary
                        sleep($delay);
                    }
                }

                if($integration->type == 'Twillio')
                {
                    $sid = $integration->sid;
                    $auth_token = $integration->token;
                    $from_number = $integration->from;
                    $sender_name = $ba->sender_name;

                    try {
                        $sid = $sid; // Your Account SID from www.twilio.com/console
                        $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
                        $from_number = $from_number; // Valid Twilio number

                        $client = new twilio($sid, $auth_token);

                        $count = 0;

                        foreach( $birthdayContactLists as $contact )
                        {
                            $count++;

                            $RECIPIENT = $contact->phone;

                            $MESSAGE = str_replace('$name', $contact->name, $ba->message);

                            $client->messages->create(
                                $RECIPIENT,
                                [
                                    'from' => $from_number,
                                    'body' => $MESSAGE,
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

            if ($ba->sms_type == 'anniversary') {
                $birthdayContactLists = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('anniversary', '=', date('m'))->whereDay('anniversary', '=', date('d'))->select('phone', 'name')->get();

                if ($birthdayContactLists->isEmpty()) {
                    return;
                }

                $integration = Integration::find($ba->integration);

                if ($integration->type == "Multitexter") {
                    $email = $integration->email;
                    $password = $integration->password;
                    $sender_name = $ba->sender_name;
                    $api_key = $integration->api_key;

                    foreach($birthdayContactLists as $contact)
                    {
                        $recipients = $contact->phone;
                        $message = str_replace('$name', $contact->name, $ba->message);

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
                    }
                }

                if ($integration->type == "NigeriaBulkSms") {
                    // Initialize variables ( set your variables here )
                    $username = $integration->username;
                    $password = $integration->password;
                    $sender = $ba->sender_name;

                    foreach($birthdayContactLists as $contact)
                    {
                        $mobiles = $contact->phone;

                        $MESSAGE = str_replace('$name', $contact->name, $ba->message);

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
                            $data = array('username' => $username, 'password' => $password, 'sender' => $sender, 'message' => $MESSAGE, 'mobiles' => $mobiles);

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
                }

                if($integration->type == 'Twillio')
                {
                    $sid = $integration->sid;
                    $auth_token = $integration->token;
                    $from_number = $integration->from;
                    $sender_name = $ba->sender_name;

                    try {
                        $sid = $sid; // Your Account SID from www.twilio.com/console
                        $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
                        $from_number = $from_number; // Valid Twilio number

                        $client = new twilio($sid, $auth_token);

                        $count = 0;

                        foreach( $birthdayContactLists as $contact )
                        {
                            $count++;

                            $RECIPIENT = $contact->phone;

                            $MESSAGE = str_replace('$name', $contact->name, $ba->message);

                            $client->messages->create(
                                $RECIPIENT,
                                [
                                    'from' => $from_number,
                                    'body' => $MESSAGE,
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

        return Command::SUCCESS;
    }
}
