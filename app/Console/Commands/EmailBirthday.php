<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\EmailKit;
use App\Models\BirthdayContact;
use Illuminate\Console\Command;
use App\Jobs\ProcessEmailBirthday;
use App\Models\BirthdayAutomation;
use Illuminate\Support\Facades\Log;
use App\Models\ListManagementContact;


class EmailBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailbirthday:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for due birthday campaign and send through email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $current_date = $date->format('Y-m-d');
        $currentDate = Carbon::today()->toDateString();

        $birthday_automation = BirthdayAutomation::where('automation', 'email automation')
            ->where('action', 'Play')
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->get();

        // Log::info($birthday_automation);

        $birthday_automation->map(function ($_campaign) use ($date) {
            $email_kit = EmailKit::where('id', $_campaign->email_kit_id)->first();

            $current_day = $date->format('d');
            $current_month = $date->format('m');

            if ($_campaign->sms_type == 'birthday') {

                $lists = ListManagementContact::where(['list_management_id' => $_campaign->birthday_contact_list_id])
                    ->whereMonth('date_of_birth', $current_month)
                    ->whereDay('date_of_birth', $current_day)->get();

                Log::info($lists);
                // divide into 500 chunks and
                // delay each job between 10  - 20 sec in the queue
                $chunks = $lists->chunk(500);
                $delay = mt_rand(10, 20);

                // template 1
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessEmailBirthday::dispatch([
                        'smtp_host'    => $email_kit->host,
                        'smtp_port'    => $email_kit->port,
                        'smtp_username'  => $email_kit->username,
                        'smtp_password'  => $email_kit->password,
                        'from_email'    => $email_kit->from_email,
                        'from_name'    => $email_kit->from_name,
                    ], $_chunk, ['email_kit' => $email_kit, 'birthday_automation' => $_campaign])
                        ->onQueue('emailBirthday')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            if ($_campaign->sms_type == 'anniversary') {
                $lists = ListManagementContact::where(['list_management_id' => $_campaign->birthday_contact_list_id, 'subscribe' => true])
                    ->whereMonth('anniv_date', $current_month)
                    ->whereDay('anniv_date', $current_day)->get();

                // divide into 500 chunks and
                // delay each job between 10  - 20 sec in the queue
                $chunks = $lists->chunk(500);
                $delay = mt_rand(10, 20);

                // template 1
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessEmailBirthday::dispatch([
                        'smtp_host'    => $email_kit->host,
                        'smtp_port'    => $email_kit->port,
                        'smtp_username'  => $email_kit->username,
                        'smtp_password'  => $email_kit->password,
                        'from_email'    => $email_kit->from_email,
                        'from_name'    => $email_kit->from_name,
                    ], $_chunk, ['email_kit' => $email_kit, 'birthday_automation' => $_campaign])
                        ->onQueue('emailBirthday')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }
        });

        return Command::SUCCESS;
    }
}
