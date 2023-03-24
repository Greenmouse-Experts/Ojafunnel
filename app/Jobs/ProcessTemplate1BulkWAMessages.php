<?php

namespace App\Jobs;

use App\Models\WaQueues;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class ProcessTemplate1BulkWAMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 7200;
    public $failOnTimeout = true;
    public $tries = 1;
    public $maxExceptions = 1;

    // 
    public $contacts;
    public $whatsapp_account;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $contacts, $whatsapp_account, $data)
    {
        $this->contacts = $contacts;
        $this->whatsapp_account = $whatsapp_account;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $whatsapp_account = explode('-', $this->whatsapp_account);
        $full_jwt_session = explode(':', $whatsapp_account[3]);
        $msg = $this->data['template1_message'];
        $wa_campaign_id = $this->data['wa_campaign_id'];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $full_jwt_session[1]
        ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_account[1] . '/check-connection-session');
        $res = $response->json();

        // check connection
        if (array_key_exists('status', $res) && array_key_exists('message', $res)) {
            if ($res['status'] == false && $res['message'] == 'Disconnected') {
                // update the wa queues to disconnected
                WaQueues::where(['wa_campaign_id' => $wa_campaign_id])->update([
                    'status' => 'Disconnected'
                ]);

                // send mail to inform that their whatsapp account is not connected
            } else {
                // start sending
                $this->contacts->map(function ($_contact) use ($whatsapp_account, $full_jwt_session, $msg, $wa_campaign_id) {
                    $contact = strpos($_contact->phone_number, '+') === 0
                        ? substr($_contact->phone_number, 1) . "@c.us"
                        : $_contact->phone_number  . "@c.us";

                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $full_jwt_session[1]
                    ])->post(
                        env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_account[1] . '/send-message',
                        [
                            "phone" => $contact,
                            "message" => $msg,
                        ]
                    );

                    $data = $response->json();

                    if (array_key_exists('message', $data)) {
                        // invalid 
                        if (str_ends_with($data['message'], 'não existe.')) {
                            // invalid 
                            WaQueues::where(['wa_campaign_id' => $wa_campaign_id, 'phone_number' => $_contact->phone_number])->update([
                                'status' => 'Invalid'
                            ]);
                        }

                        // disconnect
                        if (str_ends_with($data['message'], 'não está ativa.')) {
                            // send mail for schedule if disconnected

                            // disconnect
                            WaQueues::where(['wa_campaign_id' => $wa_campaign_id, 'phone_number' => $_contact->phone_number])->update([
                                'status' => 'Disconnected'
                            ]);
                        }
                    }

                    // sent
                    if (array_key_exists('response', $data)) {
                        if ($data['response'] != null) WaQueues::where(['wa_campaign_id' => $wa_campaign_id, 'phone_number' => $_contact->phone_number])->update([
                            'status' => 'Sent'
                        ]);
                    }

                    Log::info($data);
                });
            }
        }
    }
}
