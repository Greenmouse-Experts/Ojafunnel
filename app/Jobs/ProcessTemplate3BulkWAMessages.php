<?php

namespace App\Jobs;

use App\Models\WaQueues;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessTemplate3BulkWAMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        //
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
        $data = $this->data;
        $wa_campaign_id = $this->data['wa_campaign_id'];

        $this->contacts->map(function ($_contact) use ($whatsapp_account, $full_jwt_session, $data, $wa_campaign_id) {
            $contact = strpos($_contact->phone_number, '+') === 0
                ? substr($_contact->phone_number, 1) . "@c.us"
                : $_contact->phone_number  . "@c.us";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->post(
                env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_account[1] . '/send-message',
                [
                    "phone" => $contact,
                    "message" => $data['template3_message'],
                    "options" => [
                        "useTemplateButtons" => true,
                        "title" =>  $data['template3_header'],
                        "footer" =>  $data['template3_footer'],
                        "buttons" => [
                            [
                                "url" =>  $data['template3_link_url'],
                                "text" =>  $data['template3_link_cta']
                            ],
                            [
                                "phoneNumber" =>  $data['template3_phone_number'],
                                "text" => $data['template3_phone_cta']
                            ]
                        ],
                    ]
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
