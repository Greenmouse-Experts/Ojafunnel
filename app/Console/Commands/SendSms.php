<?php

namespace App\Console\Commands;

use App\Jobs\StoreCampaignJob;
use Illuminate\Console\Command;
use App\Enums\SmsCampaignStatus;
use App\Enums\SmsLogStatus;
use App\Enums\SmsQueueStatus;
use App\Models\SmsCampaign;
use App\Models\SmsCampaignList;
use App\Models\SmsLog;
use App\Models\SmsQueue;
use \Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client as twilio;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smsCampaign:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run SmS campaign';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $fromDate = Carbon::now()->subDays(3)->toDateTimeString();
        $toDate   = Carbon::now()->toDateTimeString();
        //collect recurring campaign and check status
        $recurring = SmsCampaign::where('schedule_type', 'recurring')->where('status', 'scheduled')->whereBetween('schedule_time', [$fromDate, $toDate])->get();
        $onetime = SmsCampaign::where('schedule_type', 'onetime')->where('status', 'scheduled')->whereBetween('schedule_time', [$fromDate, $toDate])->get();
        $message = SmsCampaign::where('schedule_type', 'onetime')->where('status', 'scheduled')->whereBetween('schedule_time', [$fromDate, $toDate])->get();

        if ($onetime->count() > 0) {
            foreach ($onetime as $sms) {
                if ($sms->schedule_time < Carbon::now()->toDateTimeString()) {
                    // recurring running
                    dispatch(new StoreCampaignJob($sms->id));

                    $contact = \App\Models\SMSQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();
                    $sms->status = 'delivered';
                    $sms->delivery_at = Carbon::now()->toDateTimeString();
                    $sms->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        // 'DeliveredCount' => $sms->readCache('DeliveredCount') + 1,
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    if ($sms->integration == "Multitexter") 
                    {
                        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

                        $d = $contact->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // \Log::info($datum);

                        $email = $integration->email;
                        $password = $integration->password;
                        $message = $sms->message;
                        $sender_name = $sms->sender_name;
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

                    if ($sms->integration == "NigeriaBulkSms") 
                    {
                        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

                        $d = $contact->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // Initialize variables ( set your variables here )
                        $username = $integration->username;
                        $password = $integration->password;
                        $sender = $sms->sender_name;
                        $message = $sms->message;
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

                        } catch (Exception $e) {
                            $responseBody = $e;
                        }
                    }

                    if($sms->integration == 'Twillio')
                    {
                        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

                        $d = $contact->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        $sid = $integration->sid;
                        $auth_token = $integration->token;
                        $from_number = $integration->from;
                        $message = $sms->message;
                        $sender_name = $sms->sender_name;
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

                    $data = $sms->update();
                }
            }
        }
        //\Log::info($recurring);
        if ($recurring->count() > 0) {
            foreach ($recurring as $sms) {
                if ($sms->recurring_end > Carbon::now()->toDateTimeString()) {
                    //\Log::info([$sms->recurring_end, Carbon::now()->toDateTimeString()]);
                    // recurring running
                    dispatch(new StoreCampaignJob($sms->id));

                    if ($sms->frequency_cycle != 'custom') {
                        $schedule_cycle = $sms::scheduleCycleValues();
                        $limits = $schedule_cycle[$sms->frequency_cycle];
                        $frequency_amount = $limits['frequency_amount'];
                        $frequency_unit = $limits['frequency_unit'];
                    } else {
                        $frequency_amount = $sms->frequency_amount;
                        $frequency_unit = $sms->frequency_unit;
                    }

                    $contact = \App\Models\SmsQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();
                    // \Log::info($contact);
                    $schedule_date = $sms->nextScheduleDate($sms->schedule_time, $frequency_unit, $frequency_amount);

                    // $new_camp = $sms->replicate()->fill([
                    //         'status'        => 'scheduled',
                    //         'schedule_time' => $schedule_date,
                    // ]);
                    $sms->status = 'scheduled';
                    $sms->schedule_time = $schedule_date;
                    $sms->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        // 'DeliveredCount' => $sms->readCache('DeliveredCount') + 1,
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    if ($sms->integration == "Multitexter") 
                    {
                        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

                        $d = $contact->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // \Log::info($datum);

                        $email = $integration->email;
                        $password = $integration->password;
                        $message = $sms->message;
                        $sender_name = $sms->sender_name;
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
                    }

                    if ($sms->integration == "NigeriaBulkSms") 
                    {
                        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

                        $d = $contact->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        // Initialize variables ( set your variables here )
                        $username = $integration->username;
                        $password = $integration->password;
                        $sender = $sms->sender_name;
                        $message = $sms->message;
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

                        } catch (Exception $e) {
                            $responseBody = $e;
                        }
                    }

                    if($sms->integration == 'Twillio')
                    {
                        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

                        $d = $contact->toArray();

                        foreach ($d as $val) {
                            $str = implode(',', $val);
                            $data[] = $str;
                        }
                        $datum = implode(',', $data);

                        $sid = $integration->sid;
                        $auth_token = $integration->token;
                        $from_number = $integration->from;
                        $message = $sms->message;
                        $sender_name = $sms->sender_name;
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

                    $data = $sms->update();

                    // if ($data) {

                    //     //insert campaign contact list
                    //     foreach (SmsCampaignsList::where('campaign_id', $sms->id)->cursor() as $list) {
                    //         SmsCampaignsList::create([
                    //                 'campaign_id'     => $new_camp->id,
                    //                 'contact_list_id' => $list->contact_list_id,
                    //         ]);
                    //     }

                    //     //insert campaign recipients
                    //     foreach (SmsCampaignsRecipients::where('campaign_id', $sms->id)->cursor() as $recipients) {
                    //         SmsCampaignsRecipients::create([
                    //                 'campaign_id' => $new_camp->id,
                    //                 'recipient'   => $recipients->recipient,
                    //         ]);
                    //     }


                    //     // //insert campaign sender ids
                    //     // foreach (CampaignsSenderid::where('campaign_id', $sms->id)->cursor() as $sender_ids) {
                    //     //     CampaignsSenderid::create([
                    //     //             'campaign_id' => $new_camp->id,
                    //     //             'sender_id'   => $sender_ids->sender_id,
                    //     //             'originator'  => $sender_ids->originator,
                    //     //     ]);
                    //     // }


                    //     // //insert campaign sending servers
                    //     // foreach (CampaignsSendingServer::where('campaign_id', $sms->id)->cursor() as $servers) {
                    //     //     CampaignsSendingServer::create([
                    //     //             'campaign_id'       => $new_camp->id,
                    //     //             'sending_server_id' => $servers->sending_server_id,
                    //     //             'fitness'           => $servers->fitness,
                    //     //     ]);
                    //     // }
                    // }

                } else {
                    //recurring date end
                    $sms->delivered();
                }
            }
        }
        return 0;
        //return Command::SUCCESS;
    }
}
