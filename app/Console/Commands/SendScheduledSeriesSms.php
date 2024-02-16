<?php

namespace App\Console\Commands;

use App\Models\ListManagementContact;
use App\Models\SentSeriesMessage;
use App\Models\SeriesSmsCampaign;
use App\Models\SmsCampaign;
use Aws\Sns\SnsClient;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as twilio;

class SendScheduledSeriesSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:scheduled-series-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled series sms to newly joined contacts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $smsSeriesIJ = SeriesSmsCampaign::where(['action' => 'Play', 'day' => 'Immediately Joined'])->get();
        $smsSeriesSMJ = SeriesSmsCampaign::where(['action' => 'Play', 'day' => 'Same Day Joined'])->get();

        foreach ($smsSeriesIJ as $sms) {
            // Convert $sms->date to a Carbon instance
            $campaignDate = Carbon::parse($sms->date);
            $followup = SmsCampaign::find($sms->sms_campaign_id);

            // Retrieve new contacts created after the SMS series was created
            $newContacts = ListManagementContact::where('list_management_id', $sms->sms_campaign_id)
                    ->where('created_at', '>=', $campaignDate->subMinutes(15))
                    ->where('subscribe', true)
                    ->select('id', 'phone', 'name', 'created_at')
                    ->get();

            foreach ($newContacts as $newContact) {
                // Check if the message has already been sent to this contact
                if (!$this->messageSent($sms, $newContact, $sms->day)) {
                    // Send the SMS message
                    $this->sendSmsToContact($followup, $newContact, $sms);
                    // Log or handle the message sending process
                    $this->logMessageSent($sms, $newContact, $sms->day);
                }
            }
        }

        foreach($smsSeriesSMJ as $sms)
        {
            // Retrieve new contacts created on the same day as the SMS campaign
            $newContacts = ListManagementContact::where('list_management_id', $sms->sms_campaign_id)
                ->whereDate('created_at', $campaignDate->toDateString()) // Filter for contacts created on the same day
                ->where('subscribe', true)
                ->select('id', 'phone', 'name', 'created_at')
                ->get();

            foreach ($newContacts as $contact) {
                // Check if the message has already been sent to this contact
                if (!$this->messageSent($sms, $contact, $sms->day)) {
                    // Send the SMS message
                    $this->sendSmsToContact($followup, $contact, $sms);
                    // Log or handle the message sending process
                    $this->logMessageSent($sms, $contact, $sms->day);
                }
            }
        }

        return Command::SUCCESS;
    }


    // Check if the message has already been sent to this contact
    protected function messageSent($sms, $contact, $type)
    {
        // Query the SentMessage table to check if there is a record for this SMS campaign and contact
        return SentSeriesMessage::where('sms_campaign_id', $sms->id)
            ->where('contact_id', $contact->id)
            ->where('type', $type)
            ->exists();
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
                        // Log::info('Message failed - error: ' . $result->error);
                        $sms->FailedDeliveredCount =  $sms->FailedDeliveredCount + 1;
                    } else {
                        // Could not determine the message response.
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

    // Log the message sending process
    protected function logMessageSent($sms, $contact, $day)
    {
        // Create a new record in the SentMessage table to mark that the message has been sent
        SentSeriesMessage::create([
            'sms_campaign_id' => $sms->id,
            'contact_id' => $contact->id,
            'type' => $day, // Or the actual timestamp when the message was sent
        ]);
    }

}
