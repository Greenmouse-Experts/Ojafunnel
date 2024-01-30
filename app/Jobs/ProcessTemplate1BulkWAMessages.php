<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\WaQueues;
use App\Mail\WADisconnected;
use App\Models\WaCampaigns;
use App\Models\SeriesWaCampaign;
use App\Models\CandidateWASeries;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessTemplate1BulkWAMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // queue setting 
    public $tries = 5;

    // 
    public $contacts;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $contacts, $data)
    {
        $this->contacts = $contacts;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $whatsapp_account = $this->data['whatsapp_account'];
            $full_jwt_session = explode(':', $this->data['full_jwt_session']);
            $msg = $this->data['template1_message'];
            $wa_campaign_id = $this->data['wa_campaign_id'];

            $series_id = null;

            if( (array_key_exists('series_id', $this->data)) ) {
                $series_id = $this->data['series_id'];
            }

            $later = false;
            if( (array_key_exists('later', $this->data)) ) {
                $later = true;
            }


            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_account . '/check-connection-session');
            $res = $response->json();


            // check connection
            if (array_key_exists('status', $res) && array_key_exists('message', $res)) {
                if ($res['status'] == false && $res['message'] == 'Disconnected') {
                    // update the wa queues to disconnected
                    WaQueues::where(['wa_campaign_id' => $wa_campaign_id])->update([
                        'status' => 'Disconnected'
                    ]);

                    // get campaign and user data
                    $campaign = WaCampaigns::find($wa_campaign_id)->first();
                    $user = User::find($campaign->user_id)->first();

                    // send mail to inform that their whatsapp account is not connected
                    Mail::to($user->email)->send(new WADisconnected($campaign));
                } else {
                    // start sending
                    $this->contacts->map(function ($_contact) use ($whatsapp_account, $full_jwt_session, $msg, $wa_campaign_id, $series_id) {
                        
                        

                        $contact = strpos($_contact->phone, '+') === 0
                            ? substr($_contact->phone, 1) . "@c.us"
                            : $_contact->phone  . "@c.us";


                        $response = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $full_jwt_session[1]
                        ])->post(
                            env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_account . '/send-message',
                            [
                                "phone" => $contact,
                                "message" => str_replace("\$name", $_contact->name, $msg),
                            ]
                        );

                        $data = $response->json();

                        Log::info("sent");

                        if (array_key_exists('message', $data)) {
                            // invalid 
                            if (str_ends_with($data['message'], 'não existe.')) {
                                // invalid  
                                $queue = WaQueues::where(['wa_campaign_id' => $wa_campaign_id, 'phone_number' => $_contact->phone]);

                                if ($queue) {
                                    $queue->update([
                                        'status' => 'Invalid'
                                    ]);
                                } else {
                                    echo $_contact->phone;
                                    // when user adds new contact while launch schedule/immediate campaign
                                    $queue = new WaQueues();
                                    $queue->wa_campaign_id = $wa_campaign_id;
                                    $queue->phone_number =  $_contact->phone;
                                    $queue->status =  'Invalid';

                                    $queue->save();
                                }
                            }

                            // disconnect
                            if (str_ends_with($data['message'], 'não está ativa.')) {
                                // send mail for schedule if disconnected

                                // disconnect
                                $queue = WaQueues::where(['wa_campaign_id' => $wa_campaign_id, 'phone_number' => $_contact->phone]);

                                if ($queue) {
                                    $queue->update([
                                        'status' => 'Disconnected'
                                    ]);
                                } else {
                                    // when user adds new contact while launch schedule/immediate campaign
                                    $queue = new WaQueues();
                                    $queue->wa_campaign_id = $wa_campaign_id;
                                    $queue->phone_number =  $_contact->phone;
                                    $queue->status =  'Disconnected';

                                    $queue->save();
                                }
                            }
                        }

                        // sent
                        if (array_key_exists('response', $data)) {
                            if ($data['response'] != null) {
                                $queue = WaQueues::where(['wa_campaign_id' => $wa_campaign_id, 'phone_number' => $_contact->phone]);

                                if ($queue) {
                                    $queue->update([
                                        'status' => 'Sent'
                                    ]);
                                } else {
                                    // when user adds new contact while launch schedule/immediate campaign
                                    $queue = new WaQueues();
                                    $queue->wa_campaign_id = $wa_campaign_id;
                                    $queue->phone_number =  $_contact->phone;
                                    $queue->status =  'Sent';

                                    $queue->save();
                                }

                                // update deliveredCount in the series compaign Table.
                                if(!is_null($series_id)) {

                                    $series = SeriesWaCampaign::find($series_id);
                                    $last_count = (int) $series->DeliveredCount;
                                    $next_count =  $last_count + 1;
                                    SeriesWaCampaign::where(['id' => $series_id])
                                        ->update([
                                            'DeliveredCount' => $next_count
                                        ]);

                                }

                                
                                if((array_key_exists('later', $this->data))) {
                                    
                                    $series = CandidateWASeries::find($series_id);
                                    $last_count = (int) $series->DeliveredCount;
                                    $next_count =  $last_count + 1;
                                    CandidateWASeries::where(['id' => $series_id])
                                        ->update([
                                            'delivered_count' => 1,
                                            'status' => 'Sent'
                                        ]);
                                }
                                
                            }
                        }

                        Log::info($data);
                    });
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            if ($this->attempts() > 5) {
                // hard fail after 5 attempts
                throw $th;
            }

            // re-queue this job to be executes
            // in 3 minutes (180 seconds) from now
            $this->release(180);

            return;
        }
    }
}
