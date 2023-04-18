<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\EmailCampaignMail;
use App\Models\EmailCampaignQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessEmailCampaign implements ShouldQueue
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
            $email_campaign = $this->data['email_campaign'];
            $email_kit = $this->data['email_kit'];
            $email_template = $this->data['email_template'];
            $user = $this->data['user'];

            $this->contacts->map(function ($_contact) use ($mailer, $email_campaign, $email_kit, $email_template, $user) {
                $mailable = new EmailCampaignMail($email_campaign, $email_kit, $email_template, $_contact, $user);

                // update status to Sending
                EmailCampaignQueue::where(['email_campaign_id' => $email_campaign->id, 'recepient' => $_contact->email])
                    ->update(['status' => 'Sending']);

                // send email
                $mailer->to($_contact->email)->send($mailable);

                // update status to Sent
                EmailCampaignQueue::where(['email_campaign_id' => $email_campaign->id, 'recepient' => $_contact->email])
                    ->update(['status' => 'Sent']);
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
