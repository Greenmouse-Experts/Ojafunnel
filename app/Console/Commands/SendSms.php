<?php

namespace App\Console\Commands;

use App\Jobs\StoreCampaignJob;
use Illuminate\Console\Command;
use App\Enums\SmsCampaignStatus;
use App\Enums\SmsLogStatus;
use App\Enums\SmsQueueStatus;
use App\Models\Integration;
use App\Models\SmsCampaign;
use App\Models\SmsCampaignList;
use App\Models\SmsLog;
use App\Models\SmsQueue;
use \Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Twilio\Rest\Client as twilio;
use Illuminate\Support\Str;
use Aws\Sns\SnsClient;
use Illuminate\Support\Facades\Log;

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
        // onetime, daily, weekly, monthly, yearly, and custom handler
        $this->oneTimeHandler();
        $this->dailyHandler();
        $this->monthlyHandler();
        $this->yearlyHandler();
        $this->customHandler();

        return Command::SUCCESS;
    }


    public function oneTimeHandler()
    {
        $oneMinuteAgo = Carbon::now()->subMinute();
        $oneMinuteLater = Carbon::now()->addMinute();

        $onetime = SmsCampaign::where('schedule_type', 'onetime')
                ->where('status', 'scheduled')
                ->where('action', 'Play')
                ->whereBetween('schedule_time', [$oneMinuteAgo, $oneMinuteLater])
                ->get();

        if ($onetime->count() > 0) {
            foreach ($onetime as $sms) {
                $contact = SMSQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();

                if ($sms->integration == "Multitexter")
                {
                    $this->sendMessageMultitexter($sms);
                }

                if ($sms->integration == "NigeriaBulkSms")
                {
                    $this->sendMessageNigeriaBulkSms($sms);
                }

                if($sms->integration == 'Twillio')
                {
                    $this->sendMessageTwilio($sms);
                }

                if($sms->integration == 'AWS')
                {
                    $this->sendMessageAWS($sms);
                }

                if($sms->integration == 'InfoBip')
                {
                    $this->sendMessageInfoBip($sms);
                }

                $sms->status = 'delivered';
                $sms->delivery_at = Carbon::now()->toDateTimeString();
                $sms->cache = json_encode([
                    'ContactCount' => $sms->readCache('DeliveredCount') + $contact->count(),
                    'DeliveredCount' => $contact->count(),
                    'FailedDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                    'NotDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                ]);

                $sms->update();
            }
        }
    }

    public function dailyHandler()
    {
        $currentDateTime = Carbon::now();

        $daily = SmsCampaign::where([
            'action' => 'Play',
            'frequency_cycle' => 'daily',
            'schedule_type' => 'recurring',
        ])->whereDate('schedule_time', '<=', $currentDateTime)->whereDate('recurring_end', '>=', $currentDateTime)->get();

        if ($daily->count() > 0) {
            foreach ($daily as $sms) {
                $contact = SMSQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();

                if ($sms->integration == "Multitexter")
                {
                    $this->sendMessageMultitexter($sms);
                }

                if ($sms->integration == "NigeriaBulkSms")
                {
                    $this->sendMessageNigeriaBulkSms($sms);
                }

                if($sms->integration == 'Twillio')
                {
                    $this->sendMessageTwilio($sms);
                }

                if($sms->integration == 'AWS')
                {
                    $this->sendMessageAWS($sms);
                }

                if($sms->integration == 'InfoBip')
                {
                    $this->sendMessageInfoBip($sms);
                }

                $sms->status = 'delivered';
                $sms->delivery_at = Carbon::now()->toDateTimeString();
                $sms->cache = json_encode([
                    'ContactCount' => $sms->readCache('DeliveredCount') + $contact->count(),
                    'DeliveredCount' => $contact->count(),
                    'FailedDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                    'NotDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                ]);

                $sms->update();
            }
        }
    }

    public function monthlyHandler()
    {
        $currentDateTime = Carbon::now();

        // Add one month to the current date
        $nextMonth = $currentDateTime->copy()->addMonth();

        $monthly = SmsCampaign::where([
            'action' => 'Play',
            'frequency_cycle' => 'monthly',
            'schedule_type' => 'recurring',
        ])->where('schedule_time', '<=', $nextMonth) // Ensure scheduled time is not in a future month
          ->whereDate('recurring_end', '>=', $currentDateTime)
          ->get();

        if ($monthly->count() > 0) {
            foreach ($monthly as $sms) {
                $contact = SMSQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();

                if ($sms->integration == "Multitexter")
                {
                    $this->sendMessageMultitexter($sms);
                }

                if ($sms->integration == "NigeriaBulkSms")
                {
                    $this->sendMessageNigeriaBulkSms($sms);
                }

                if($sms->integration == 'Twillio')
                {
                    $this->sendMessageTwilio($sms);
                }

                if($sms->integration == 'AWS')
                {
                    $this->sendMessageAWS($sms);
                }

                if($sms->integration == 'InfoBip')
                {
                    $this->sendMessageInfoBip($sms);
                }

                $sms->status = 'delivered';
                $sms->delivery_at = Carbon::now()->toDateTimeString();
                $sms->cache = json_encode([
                    'ContactCount' => $sms->readCache('DeliveredCount') + $contact->count(),
                    'DeliveredCount' => $contact->count(),
                    'FailedDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                    'NotDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                ]);

                $sms->update();
            }
        }
    }

    public function yearlyHandler()
    {
        $currentDateTime = Carbon::now();

        // Add one year to the current date
        $nextYear = $currentDateTime->copy()->addYear();

        $yearly = SmsCampaign::where([
            'action' => 'Play',
            'frequency_cycle' => 'yearly',
            'schedule_type' => 'recurring',
        ])->where('schedule_time', '<=', $nextYear) // Ensure scheduled time is not in a future year
            ->whereDate('recurring_end', '>=', $currentDateTime)
            ->get();

        if ($yearly->count() > 0) {
            foreach ($yearly as $sms) {
                $contact = SMSQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();

                if ($sms->integration == "Multitexter")
                {
                    $this->sendMessageMultitexter($sms);
                }

                if ($sms->integration == "NigeriaBulkSms")
                {
                    $this->sendMessageNigeriaBulkSms($sms);
                }

                if($sms->integration == 'Twillio')
                {
                    $this->sendMessageTwilio($sms);
                }

                if($sms->integration == 'AWS')
                {
                    $this->sendMessageAWS($sms);
                }

                if($sms->integration == 'InfoBip')
                {
                    $this->sendMessageInfoBip($sms);
                }

                $sms->status = 'delivered';
                $sms->delivery_at = Carbon::now()->toDateTimeString();
                $sms->cache = json_encode([
                    'ContactCount' => $sms->readCache('DeliveredCount') + $contact->count(),
                    'DeliveredCount' => $contact->count(),
                    'FailedDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                    'NotDeliveredCount' => $sms->readCache('DeliveredCount') + 0,
                ]);

                $sms->update();
            }
        }
    }

    public function customHandler()
    {
        $fromDate = Carbon::now()->subDays(3)->toDateTimeString();
        $toDate   = Carbon::now()->toDateTimeString();

        $recurring = SmsCampaign::where([
            'action' => 'Play',
            'frequency_cycle' => 'custom',
            'schedule_type' => 'recurring',
        ])->whereBetween('schedule_time', [$fromDate, $toDate])->get();

        if ($recurring->count() > 0) {
            foreach ($recurring as $sms) {
                if ($sms->recurring_end > Carbon::now()->toDateTimeString()) {
                    // recurring running

                    if ($sms->frequency_cycle != 'custom') {
                        $schedule_cycle = $sms::scheduleCycleValues();
                        $limits = $schedule_cycle[$sms->frequency_cycle];
                        $frequency_amount = $limits['frequency_amount'];
                        $frequency_unit = $limits['frequency_unit'];
                    } else {
                        $frequency_amount = $sms->frequency_amount;
                        $frequency_unit = $sms->frequency_unit;
                    }

                    $contact = SmsQueue::where('sms_campaign_id', $sms->id)->select('phone_number')->get();
                    // \Log::info($contact);
                    $schedule_date = $sms->nextScheduleDate($sms->schedule_time, $frequency_unit, $frequency_amount);

                    // $new_camp = $sms->replicate()->fill([
                    //         'status'        => 'scheduled',
                    //         'schedule_time' => $schedule_date,
                    // ]);

                    if ($sms->integration == "Multitexter")
                    {
                        $this->sendMessageMultitexter($sms);
                    }

                    if ($sms->integration == "NigeriaBulkSms")
                    {
                       $this->sendMessageNigeriaBulkSms($sms);
                    }

                    if($sms->integration == 'Twillio')
                    {
                        $this->sendMessageTwilio($sms);
                    }

                    if($sms->integration == 'AWS')
                    {
                        $this->sendMessageAWS($sms);
                    }

                    if($sms->integration == 'InfoBip')
                    {
                        $this->sendMessageInfoBip($sms);
                    }

                    $sms->status = 'scheduled';
                    $sms->schedule_time = $schedule_date;
                    $sms->cache = json_encode([
                        'ContactCount' => $contact->count(),
                        // 'DeliveredCount' => $sms->readCache('DeliveredCount') + 1,
                        'DeliveredCount' => $contact->count(),
                        'FailedDeliveredCount' => 0,
                        'NotDeliveredCount' => 0,
                    ]);

                    $sms->update();
                } else {
                    //recurring date end
                    $sms->delivered();
                }
            }
        }
    }

    public function sendMessageTwilio($sms)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $sms->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

        $d = $contacts->toArray();

        $sid = $integration->sid;
        $auth_token = $integration->token;
        $from_number = $integration->from;
        $sender_name = $sms->sender_name;
        $recipients = $d;

        foreach( $recipients as $value )
        {
            $sid = $sid; // Your Account SID from www.twilio.com/console
            $auth_token = $auth_token; // Your Auth Token from www.twilio.com/console
            $from_number = $from_number; // Valid Twilio number

            $client = new twilio($sid, $auth_token);

            $count = 0;

            try
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

                $responseBody = true;
            } catch(Exception $e) {
                $responseBody = $e->getMessage();
            }
        }
        return $responseBody;
    }

    public function sendMessageMultitexter($sms)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $sms->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

        $email = $integration->email;
        $password = $integration->password;
        $sender_name = $sms->sender_name;
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
                $statusCode = $response->getStatusCode();
                $responseBody = $response->getBody()->getContents();
                Log::info("Multitexter SMS sent. Status Code: $statusCode, Response: $responseBody");
                $responseBody = true;
            } catch (Exception $e) {
                $responseBody = $e;
                Log::error("Error sending Multitexter SMS: " . $e->getMessage());
            }
        }

        return $responseBody;
    }

    public function sendMessageNigeriaBulkSms($sms)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $sms->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

        $username = $integration->username;
        $password = $integration->password;
        $sender = $sms->sender_name;

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
                $responseBody = $e->getMessage();
            }
        }
        return $responseBody;
    }

    public function sendMessageAWS($sms)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $sms->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

        $key = $integration->key;
        $secret = $integration->secret;
        $sender = $sms->sender_name;

        foreach($contacts as $contact)
        {
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
                $responseBody = true;
            } catch (Exception $e) {
                $responseBody = $e;
            }
        }

        return $responseBody;
    }

    public function sendMessageInfoBip($sms)
    {
        $contacts = \App\Models\ListManagementContact::where('list_management_id', $sms->maillist_id)->where('subscribe', true)->select('phone', 'name')->get();

        $integration = \App\Models\Integration::where('user_id', $sms->user_id)->where('type', $sms->integration)->first();

        $API_KEY = $integration->api_key;
        $BASE_URL = $integration->api_base_url;
        $SENDER = $sms->sender_name;

        foreach($contacts as $contact)
        {
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

                $responseBody = true;

            } catch (Exception $e) {
                $responseBody = $e;
            }
        }
        return $responseBody;
    }
}
