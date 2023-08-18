<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\EmailKit;
use App\Models\MailContact;
use App\Models\EmailCampaign;
use Illuminate\Console\Command;
use App\Jobs\ProcessEmailCampaign;
use Illuminate\Support\Facades\Log;
use App\Models\ListManagementContact;

class SendEmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailcampaign:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for due email campaign and send';
    

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

        $email_campaigns = EmailCampaign::where([
            'start_date' => $current_date,
            'start_time' => $current_time,
        ])->get();

        Log::info($email_campaigns);

        $email_campaigns->map(function ($_campaign) {
            $email_kit = EmailKit::where('id', $_campaign->email_kit_id)->first();
            $user = User::where('id', $_campaign->user_id)->first();

            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->list_id)->get();

            // divide into 500 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(500);
            $delay = mt_rand(10, 20);

            // dispatch job and delay
            foreach ($chunks as $key => $_chunk) {
                // dispatch job 
                ProcessEmailCampaign::dispatch([
                    'smtp_host'    => $email_kit->host,
                    'smtp_port'    => $email_kit->port,
                    'smtp_username'  => $email_kit->username,
                    'smtp_password'  => $email_kit->password,
                    'from_email'    => $email_kit->from_email,
                    'from_name'    => $email_kit->from_name,
                ],  $_chunk, [
                    'email_campaign' => $_campaign,
                    'email_kit' => $email_kit,
                    'user' => $user
                ])->afterCommit()->onQueue('emailCampaign')->delay($delay);

                $delay += mt_rand(10, 20);
            }
        });

        return Command::SUCCESS;
    }
}
