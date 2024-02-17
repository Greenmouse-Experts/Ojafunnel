<?php

namespace App\Console\Commands;

use App\Mail\EmailSeriesCampaign;
use App\Models\EmailCampaign;
use App\Models\EmailKit;
use App\Models\ListManagementContact;
use App\Models\SentEmailSeriesMessage;
use App\Models\SeriesEmailCampaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendScheduledSeriesEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:scheduled-series-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled series email to newly joined contacts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emailSeriesIJ = SeriesEmailCampaign::where(['action' => 'Play', 'day' => 'Immediately Joined'])->get();
        $emailSeriesSDJ = SeriesEmailCampaign::where(['action' => 'Play', 'day' => 'Same Day Joined'])->get();

        foreach ($emailSeriesIJ as $ij) {
            // Convert $email->date to a Carbon instance
            $campaignDate = Carbon::parse($ij->date);
            $followup = EmailCampaign::find($ij->email_campaign_id);
            $emailKit = EmailKit::find($followup->email_kit_id);
            $user = User::find($ij->user_id);

            // Retrieve new contacts created after the Email series was created
            $newContacts = ListManagementContact::where('list_management_id', $followup->list_id)
                    ->where('created_at', '>=', $campaignDate->subMinutes(15))
                    ->where('subscribe', true)
                    ->select('id', 'email', 'name', 'created_at')
                    ->get();

            foreach ($newContacts as $newContact) {
                // Check if the message has already been sent to this contact
                if (!$this->messageSent($ij, $newContact, $ij->day)) {
                    // Send the Email message
                    $this->sendEmailToContact($followup, $emailKit, $user, $newContact, $ij);

                    // Log or handle the message sending process
                    $this->logMessageSent($ij, $newContact, $ij->day);
                }
            }
        }

        foreach($emailSeriesSDJ as $sdj)
        {
            $campaignDate = Carbon::parse($sdj->date);
            $followup = EmailCampaign::find($sdj->email_campaign_id);
            $emailKit = EmailKit::find($followup->email_kit_id);
            $user = User::find($sdj->user_id);

            // Retrieve new contacts created on the same day as the Email campaign
            $newContacts = ListManagementContact::where('list_management_id', $followup->list_id)
                ->whereDate('created_at', $campaignDate->toDateString()) // Convert campaignDate to UTC timezone
                ->where('subscribe', true)
                ->select('id', 'email', 'name', 'created_at')
                ->get();

            foreach ($newContacts as $contact) {
               // Check if the message has already been sent to this contact
                if (!$this->messageSent($sdj, $contact, $sdj->day)) {
                    // Send the Email message
                    $this->sendEmailToContact($followup, $emailKit, $user, $contact, $sdj);
                    // Log or handle the message sending process
                    $this->logMessageSent($sdj, $contact, $sdj->day);
                }
            }
        }

        return Command::SUCCESS;
    }

    // Check if the message has already been sent to this contact
    protected function messageSent($ij, $contact, $type)
    {
        // Query the SentMessage table to check if there is a record for this Email campaign and contact
        return SentEmailSeriesMessage::where('email_campaign_id', $ij->id)
            ->where('contact_id', $contact->id)
            ->where('type', $type)
            ->exists();
    }

    private function sendEmailToContact($emailCampaign, $emailKit, $user, $contact, $ij)
    {
        // $delay = mt_rand(10, 20);

        // Dynamically set mail configuration
        $configuration = [
            'smtp_host' => $emailKit->host,
            'smtp_port' => $emailKit->port,
            'smtp_username' => $emailKit->username,
            'smtp_password' => $emailKit->password,
            'from_email' => $emailKit->from_email,
            'from_name' => $emailKit->from_name,
        ];

        $mailer = app()->makeWith('user.mailer', $configuration);


        $email = new EmailSeriesCampaign($ij, $emailCampaign, $emailKit, $contact, $user);

        // Send email using the retrieved mailer instance
        $mailer->to($contact->email)->send($email);

        // Introduce a delay if necessary
        // sleep($delay);
    }

    // Log the message sending process
    protected function logMessageSent($ij, $contact, $type)
    {
        $ij->update([
            'sent' => $ij->sent + 1
        ]);

        // Create a new record in the SentMessage table to mark that the message has been sent
        SentEmailSeriesMessage::create([
            'email_campaign_id' => $ij->id,
            'contact_id' => $contact->id,
            'type' => $type, // Or the actual timestamp when the message was sent
        ]);
    }

}
