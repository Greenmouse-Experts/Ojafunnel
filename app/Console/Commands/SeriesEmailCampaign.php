<?php

namespace App\Console\Commands;

use App\Jobs\ProcessEmailCampaign;
use App\Models\EmailCampaign;
use App\Models\EmailKit;
use App\Models\SeriesEmailCampaign as SeriesEmailCampaignModel;
use App\Models\ListManagementContact;
use App\Models\User;
use App\Mail\EmailCampaignMail;
use App\Mail\EmailSeriesCampaign;
use App\Mailers\CustomMailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SeriesEmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seriesEmailcampaign:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for due series email campaign and send';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i');

        $seriesEmailCampaigns = SeriesEmailCampaignModel::where('date', $currentDate)
            ->where('time', $currentTime)
            ->get();

        $seriesEmailCampaigns->each(function ($seriesEmailCampaign) {
            $emailCampaign = EmailCampaign::find($seriesEmailCampaign->email_campaign_id);
            $emailKit = EmailKit::find($emailCampaign->email_kit_id);
            $user = User::find($seriesEmailCampaign->user_id);

            $contacts = ListManagementContact::where('list_management_id', $emailCampaign->list_id)
                ->latest()
                ->get();

            $delay = mt_rand(10, 20);

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

            $contacts->each(function ($contact) use ($seriesEmailCampaign, $emailCampaign, $emailKit, $user, $delay, $mailer) {
                // Build the message instance
                $email = new EmailSeriesCampaign($seriesEmailCampaign, $emailCampaign, $emailKit, $contact, $user);

                // Send email using the retrieved mailer instance
                $mailer->to($contact->email)->send($email);

                // Introduce a delay if necessary
                sleep($delay);
            });
        });

        Log::info('Series email campaigns scheduled successfully.');
    }
}
