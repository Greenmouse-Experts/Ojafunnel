<?php

namespace App\Jobs;

use App\Mail\BirthdayWADisconnected;
use App\Models\User;
use App\Models\BirthdayWAQueue;
use App\Models\BirthdayAutomation;
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

class ProcessWABirthday implements ShouldQueue
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
            $msg = $this->data['message'];
            $birthday_automation_id = $this->data['birthday_automation_id'];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $full_jwt_session[1]
            ])->get(env('WA_BASE_ENDPOINT') . '/api/' . $whatsapp_account . '/check-connection-session');
            $res = $response->json();

            // check connection
            if (array_key_exists('status', $res) && array_key_exists('message', $res)) {
                if ($res['status'] == false && $res['message'] == 'Disconnected') {
                    // update the wa queues to disconnected
                    BirthdayWAQueue::where(['birthday_automation_id' => $birthday_automation_id])->update([
                        'status' => 'Disconnected'
                    ]);

                    // get automation and user data
                    $birthday_automation = BirthdayAutomation::find($birthday_automation_id)->first();
                    $user = User::find($birthday_automation->user_id)->first();

                    // send mail to inform that their whatsapp account is not connected
                    Mail::to($user->email)->send(new BirthdayWADisconnected($birthday_automation));
                } else {
                    // check if paused or play
                    $birthday_automation = BirthdayAutomation::find($birthday_automation_id)->first();

                    // paused and stop job
                    if ($birthday_automation->action == 'Pause') {
                        $this->contacts->map(function ($_contact) use ($birthday_automation_id) {
                            $queue = BirthdayWAQueue::where([
                                'birthday_automation_id' => $birthday_automation_id,
                                'phone_number' => $_contact->phone_number
                            ]);

                            $queue->update([
                                'status' => 'Pause'
                            ]);
                        });

                        return;
                    }

                    // start sending
                    $this->contacts->map(function ($_contact) use ($whatsapp_account, $full_jwt_session, $msg, $birthday_automation_id) {
                        $contact = strpos($_contact->phone_number, '+') === 0
                            ? substr($_contact->phone_number, 1) . "@c.us"
                            : $_contact->phone_number  . "@c.us";

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

                        if (array_key_exists('message', $data)) {
                            // invalid 
                            if (str_ends_with($data['message'], 'não existe.')) {
                                // invalid  
                                $queue = BirthdayWAQueue::where(['birthday_automation_id' => $birthday_automation_id, 'phone_number' => $_contact->phone_number]);

                                if ($queue) {
                                    $queue->update([
                                        'status' => 'Invalid'
                                    ]);
                                } else {
                                    // when user adds new contact while launch schedule/immediate campaign
                                    $queue = new BirthdayWAQueue();
                                    $queue->birthday_automation_id = $birthday_automation_id;
                                    $queue->phone_number =  $_contact->phone_number;
                                    $queue->status =  'Invalid';

                                    $queue->save();
                                }
                            }

                            // disconnect
                            if (str_ends_with($data['message'], 'não está ativa.')) {
                                // send mail for schedule if disconnected

                                // disconnect
                                $queue = BirthdayWAQueue::where(['birthday_automation_id' => $birthday_automation_id, 'phone_number' => $_contact->phone_number]);

                                if ($queue) {
                                    $queue->update([
                                        'status' => 'Disconnected'
                                    ]);
                                } else {
                                    // when user adds new contact while launch schedule/immediate campaign
                                    $queue = new BirthdayWAQueue();
                                    $queue->birthday_automation_id = $birthday_automation_id;
                                    $queue->phone_number =  $_contact->phone_number;
                                    $queue->status =  'Disconnected';

                                    $queue->save();
                                }
                            }
                        }

                        // sent
                        if (array_key_exists('response', $data)) {
                            if ($data['response'] != null) {
                                $queue = BirthdayWAQueue::where(['birthday_automation_id' => $birthday_automation_id, 'phone_number' => $_contact->phone_number]);

                                if ($queue) {
                                    $queue->update([
                                        'status' => 'Sent'
                                    ]);
                                } else {
                                    // when user adds new contact while launch schedule/immediate campaign
                                    $queue = new BirthdayWAQueue();
                                    $queue->birthday_automation_id = $birthday_automation_id;
                                    $queue->phone_number =  $_contact->phone_number;
                                    $queue->status =  'Sent';

                                    $queue->save();
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
