<?php

namespace App\Jobs;

use App\Mail\BirthdayEmail;
use Illuminate\Bus\Queueable;
use App\Models\BirthdayEmailQueue;
use App\Models\EmailKit;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessEmailBirthday implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // queue setting 
    public $tries = 5;

    public $configuration;
    public $contacts;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($configuration, $contacts, $data)
    {
        $this->configuration = $configuration;
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
            $mailer = app()->makeWith('user.mailer', $this->configuration);
            $email_kit = $this->data['email_kit'];
            $birthday_automation = $this->data['birthday_automation'];

            $this->contacts->map(function ($_contact) use ($mailer, $email_kit, $birthday_automation) {
                $birthday_message = str_replace("\$name", $_contact->name, $birthday_automation->message);

                // mailable
                $mailable = new BirthdayEmail($birthday_message, $birthday_automation);

                // update status to Sending
                BirthdayEmailQueue::where(['birthday_automation_id' => $birthday_automation->id, 'email' => $_contact->email])
                    ->update(['status' => 'Sending']);

                // // send email
                $mailer->to($_contact->email)->send($mailable);

                // update status to Sent
                BirthdayEmailQueue::where(['birthday_automation_id' => $birthday_automation->id, 'email' => $_contact->email])
                    ->update(['status' => 'Sent']);

                // update email kit - `sent`
                $_email_kit  = EmailKit::where('id', $email_kit->id);
                $_email_kit->update([
                    'sent' => $_email_kit->first()->sent + 1
                ]);
            });
        } catch (\Throwable $th) {
            Log::info($th);

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