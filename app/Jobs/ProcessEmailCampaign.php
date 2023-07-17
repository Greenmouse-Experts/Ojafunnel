<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\EmailCampaignMail;
use App\Models\EmailCampaign;
use App\Models\EmailCampaignQueue;
use App\Models\EmailKit;
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
            $user = $this->data['user'];

            $this->contacts->map(function ($_contact) use ($mailer, $email_campaign, $email_kit, $user) {
                // mailable
                $mailable = new EmailCampaignMail($email_campaign, $email_kit, $_contact, $user);

                
                // update status to Sending
                EmailCampaignQueue::where(['email_campaign_id' => $email_campaign->id, 'recepient' => $_contact->email])
                    ->update(['status' => 'Sending']);

                // send email
                $mailer->to($_contact->email)->send($mailable);

                //////////////////////////////////////////////////
                \App\Models\EmailSubscriptionTag::create([
                    'recepient' => $_contact->email,
                    'tags'      => "campaigns"
                ]);
                //////////////////////////////////////////////////

                // update status to Sent
                EmailCampaignQueue::where(['email_campaign_id' => $email_campaign->id, 'recepient' => $_contact->email])
                    ->update(['status' => 'Sent']);

                // update email campaign - `sent`
                $_email_campaign = EmailCampaign::where('id', $email_campaign->id);
                $_email_campaign->update([
                    'sent' => $_email_campaign->first()->sent + 1
                ]);

                // update email kit - `sent`
                $_email_kit  = EmailKit::where('id', $email_kit->id);
                $_email_kit->update([
                    'sent' => $_email_kit->first()->sent + 1
                ]);
            });
        } catch (\Throwable $th) {
            Log::info($th);

            if (str_starts_with($th->getMessage(), 'Connection could not be established with host')) {
                $email_campaign = $this->data['email_campaign'];

                $this->contacts->map(function ($_contact) use ($email_campaign) {
                    // update status - Connection could not be established with host
                    EmailCampaignQueue::where(['email_campaign_id' => $email_campaign->id, 'recepient' => $_contact->email])
                        ->update(['status' => 'FAILED: Connection could not be established with host']);
                });

                return;
            }

            if (str_starts_with($th->getMessage(), 'Failed to authenticate on SMTP server')) {
                $email_campaign = $this->data['email_campaign'];

                $this->contacts->map(function ($_contact) use ($email_campaign) {
                    // update status - Failed to authenticate on SMTP server
                    EmailCampaignQueue::where(['email_campaign_id' => $email_campaign->id, 'recepient' => $_contact->email])
                        ->update(['status' => 'FAILED: Failed to authenticate on SMTP server']);
                });

                return;
            }

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
