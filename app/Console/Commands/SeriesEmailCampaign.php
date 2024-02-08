<?php

namespace App\Console\Commands;

use App\Jobs\ProcessEmailCampaign;
use App\Models\EmailCampaign;
use App\Models\EmailKit;
use App\Models\SeriesEmailCampaign as SeriesEmailCampaignModel;
use App\Models\ListManagementContact;
use App\Models\User;
use App\Mail\EmailCampaignMail;
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
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $series_email_campaigns = SeriesEmailCampaignModel::where([
            'date' => $current_date,
            'time' => $current_time,
        ])->get();

        Log::info($series_email_campaigns);

        $series_email_campaigns->map(function ($_campaign) {
            $emailCampaign = EmailCampaign::find($_campaign->email_campaign_id);
            $email_kit = EmailKit::where('id', $emailCampaign->email_kit_id)->first();
            $user = User::where('id', $_campaign->user_id)->first();

            $contacts = ListManagementContact::latest()->where('list_management_id', $emailCampaign->list_id)->get();

            // divide into 500 chunks and
            // delay each job between 10  - 20 sec in the queue
            // $chunks = $contacts->chunk(500);
            $chunks = $contacts;
            $delay = mt_rand(10, 20);

            // dispatch job and delay
            foreach ($chunks as $_chunk) {
                // dispatch job

                // ProcessEmailCampaign::dispatch([
                //     'smtp_host'    => $email_kit->host,
                //     'smtp_port'    => $email_kit->port,
                //     'smtp_username'  => $email_kit->username,
                //     'smtp_password'  => $email_kit->password,
                //     'from_email'    => $email_kit->from_email,
                //     'from_name'    => $email_kit->from_name,
                // ],  $_chunk, [
                //     'email_campaign' => $_campaign,
                //     'email_kit' => $email_kit,
                //     'user' => $user
                // ])->afterCommit()->onQueue('emailCampaign')->delay($delay);

                // $mailable = new EmailCampaignMail($_campaign, $email_kit, $_chunk, $user);
                // Mail::to($_chunk->email)->send($mailable);

                // // send email
                // @$mailer->to($_chunk->email)->send($mailable);

                // $delay += mt_rand(10, 20);

                // Dynamically set mail configuration
                config([
                    'mail.host' => $email_kit->host,
                    'mail.port' => $email_kit->port,
                    'mail.username' => $email_kit->username,
                    'mail.password' => $email_kit->password,
                    'mail.from.address' => $email_kit->from_email,
                    'mail.from.name' => $email_kit->from_name,
                ]);

                // Send email using Laravel Mail facade
                $trigger = new EmailCampaignMail($_campaign, $email_kit, $_chunk, $user);

                Mail::to($_chunk->email)->send($trigger);

                // Introduce a delay if necessary
                sleep($delay);

                $delay += mt_rand(10, 20);
            }
        });

        return Command::SUCCESS;
    }
}
