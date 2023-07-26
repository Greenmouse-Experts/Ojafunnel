<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\WhatsappNumber;
use App\Jobs\ProcessWABirthday;
use App\Models\BirthdayContact;
use Illuminate\Console\Command;
use App\Models\BirthdayAutomation;
use Illuminate\Support\Facades\Log;
use App\Models\ListManagementContact;

class WABirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wabirthday:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for due birthday campaign and send through whatsapp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $current_date = $date->format('Y-m-d');

        $birthday_automation = BirthdayAutomation::where([
            'automation' => '"whatsapp automation"',
            'action' => 'Play'
        ])->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get();

        Log::info($birthday_automation);

        $birthday_automation->map(function ($_campaign) use ($date) {
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->sender_id])->first();

            $current_day = $date->format('d');
            $current_month = $date->format('m');

            if ($_campaign->sms_type == 'birthday') {
                $lists = ListManagementContact::where(['list_management_id' => $_campaign->birthday_contact_list_id])
                    ->whereMonth('date_of_birth', $current_month)
                    ->whereDay('date_of_birth', $current_day)->get();

                // divide into 10 chunks and 
                // delay each job between 10  - 20 sec in the queue
                $chunks = $lists->chunk(10);
                $delay = mt_rand(10, 20);

                // template 1
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessWABirthday::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'message' => $_campaign->message,
                        'birthday_automation_id' => $_campaign->id
                    ])->onQueue('waBirthday')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            
            if ($_campaign->sms_type == 'anniversary') {
                $lists = ListManagementContact::where(['list_management_id' => $_campaign->birthday_contact_list_id])
                    ->whereMonth('anniv_date', $current_month)
                    ->whereDay('anniv_date', $current_day)->get();

                // divide into 10 chunks and 
                // delay each job between 10  - 20 sec in the queue
                $chunks = $lists->chunk(10);
                $delay = mt_rand(10, 20);

                // template 1
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessWABirthday::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'message' => $_campaign->message,
                        'birthday_automation_id' => $_campaign->id
                    ])->onQueue('waBirthday')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }
        });

        return Command::SUCCESS;
    }
}
