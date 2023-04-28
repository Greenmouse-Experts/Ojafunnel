<?php

namespace App\Console\Commands;

use App\Models\BirthdayAutomation;
use App\Models\BirthdayContact;
use App\Models\Integration;
use App\Models\ListManagementContact;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

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

                if ($birthdayContactList->isEmpty()) {
                    return;
                }

                // foreach (json_decode($ba->automation) as $automation) {
                // }
                if ($ba->automation == 'sms automation') {
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
                }
            }

            if ($ba->sms_type == 'anniversary') {
                $birthdayContactList = ListManagementContact::where('list_management_id', $ba->birthday_contact_list_id)->whereMonth('anniversary', '=', date('m'))->whereDay('anniversary', '=', date('d'))->select('phone')->get();
                // \Log::info($birthdayContactList);

                if ($birthdayContactList->isEmpty()) {
                    return;
                }

                // foreach (json_decode($ba->automation) as $automation) {
                // }
                if ($ba->automation == 'sms automation') {
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
                }
            }
        }

        return Command::SUCCESS;
    }
}
