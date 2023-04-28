<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\WaQueues;
use App\Models\WaCampaigns;
use App\Models\WhatsappNumber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\ListManagementContact;
use App\Jobs\ProcessTemplate1BulkWAMessages;
use App\Jobs\ProcessTemplate2BulkWAMessages;
use App\Jobs\ProcessTemplate3BulkWAMessages;

class SendWABulk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendwabulk:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for due whatsapp campaign and send';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // onetime, daily, weekly, monthly, yearly, and custom handler
        $this->oneTimeHandler();
        $this->dailyHandler();
        $this->weeklyHandler();
        $this->monthlyHandler();
        $this->yearlyHandler();
        $this->customHandler();

        return Command::SUCCESS;
    }

    public function oneTimeHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $onetime = WaCampaigns::where([
            'frequency_cycle' => 'onetime',
            'message_timing' => 'Schedule',
            'start_time' => $current_time,
            'next_due_date' => $current_date,
        ])->get();

        $onetime->map(function ($_campaign) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->get();
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            if ($_campaign->template == 'template1') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template1_message' => $_campaign->template1_message,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate1')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 2
            if ($_campaign->template == 'template2') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job 
                    ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template2_message' => $_campaign->template2_message,
                        'template2_file' => $_campaign->template2_file,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate2')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 3
            if ($_campaign->template == 'template3') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template3_header' => $_campaign->template3_header,
                        'template3_message' => $_campaign->template3_message,
                        'template3_footer' => $_campaign->template3_footer,
                        'template3_link_url' => $_campaign->template3_link_url,
                        'template3_link_cta' => $_campaign->template3_link_cta,
                        'template3_phone_number' => $_campaign->template3_phone_number,
                        'template3_phone_cta' => $_campaign->template3_phone_cta,
                        'wa_campaign_id' => $_campaign->id
                    ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // update the campaign queue to waiting
            WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
                'status' => 'Waiting'
            ]);
        });
    }

    public function dailyHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $daily = WaCampaigns::where([
            'frequency_cycle' => 'daily',
            'message_timing' => 'Schedule',
            'start_time' => $current_time,
            'next_due_date' => $current_date,
        ])->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get();

        $daily->map(function ($_campaign) use ($date) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->get();
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            if ($_campaign->template == 'template1') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template1_message' => $_campaign->template1_message,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate1')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 2
            if ($_campaign->template == 'template2') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job 
                    ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template2_message' => $_campaign->template2_message,
                        'template2_file' => $_campaign->template2_file,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate2')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 3
            if ($_campaign->template == 'template3') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template3_header' => $_campaign->template3_header,
                        'template3_message' => $_campaign->template3_message,
                        'template3_footer' => $_campaign->template3_footer,
                        'template3_link_url' => $_campaign->template3_link_url,
                        'template3_link_cta' => $_campaign->template3_link_cta,
                        'template3_phone_number' => $_campaign->template3_phone_number,
                        'template3_phone_cta' => $_campaign->template3_phone_cta,
                        'wa_campaign_id' => $_campaign->id
                    ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // update the campaign queue to waiting
            WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
                'status' => 'Waiting'
            ]);

            // update next_due_date
            WaCampaigns::where(['id' => $_campaign->id])->update([
                'next_due_date' => $date->addDays(1)->format('Y-m-d')
            ]);
        });
    }

    public function weeklyHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $weekly = WaCampaigns::where([
            'frequency_cycle' => 'weekly',
            'message_timing' => 'Schedule',
            'start_time' => $current_time,
            'next_due_date' => $current_date,
        ])->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get();

        $weekly->map(function ($_campaign) use ($date) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->get();
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            if ($_campaign->template == 'template1') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template1_message' => $_campaign->template1_message,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate1')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 2
            if ($_campaign->template == 'template2') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job 
                    ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template2_message' => $_campaign->template2_message,
                        'template2_file' => $_campaign->template2_file,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate2')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 3
            if ($_campaign->template == 'template3') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template3_header' => $_campaign->template3_header,
                        'template3_message' => $_campaign->template3_message,
                        'template3_footer' => $_campaign->template3_footer,
                        'template3_link_url' => $_campaign->template3_link_url,
                        'template3_link_cta' => $_campaign->template3_link_cta,
                        'template3_phone_number' => $_campaign->template3_phone_number,
                        'template3_phone_cta' => $_campaign->template3_phone_cta,
                        'wa_campaign_id' => $_campaign->id
                    ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // update the campaign queue to waiting
            WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
                'status' => 'Waiting'
            ]);

            // update next_due_date
            WaCampaigns::where(['id' => $_campaign->id])->update([
                'next_due_date' => $date->addWeeks(1)->format('Y-m-d')
            ]);
        });
    }

    public function monthlyHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $monthly = WaCampaigns::where([
            'frequency_cycle' => 'monthly',
            'message_timing' => 'Schedule',
            'start_time' => $current_time,
            'next_due_date' => $current_date,
        ])->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get();

        $monthly->map(function ($_campaign) use ($date) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->get();
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            if ($_campaign->template == 'template1') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template1_message' => $_campaign->template1_message,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate1')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 2
            if ($_campaign->template == 'template2') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job 
                    ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template2_message' => $_campaign->template2_message,
                        'template2_file' => $_campaign->template2_file,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate2')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 3
            if ($_campaign->template == 'template3') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template3_header' => $_campaign->template3_header,
                        'template3_message' => $_campaign->template3_message,
                        'template3_footer' => $_campaign->template3_footer,
                        'template3_link_url' => $_campaign->template3_link_url,
                        'template3_link_cta' => $_campaign->template3_link_cta,
                        'template3_phone_number' => $_campaign->template3_phone_number,
                        'template3_phone_cta' => $_campaign->template3_phone_cta,
                        'wa_campaign_id' => $_campaign->id
                    ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // update the campaign queue to waiting
            WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
                'status' => 'Waiting'
            ]);

            // update next_due_date
            WaCampaigns::where(['id' => $_campaign->id])->update([
                'next_due_date' => $date->addMonths(1)->format('Y-m-d')
            ]);
        });
    }

    public function yearlyHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $monthly = WaCampaigns::where([
            'frequency_cycle' => 'yearly',
            'message_timing' => 'Schedule',
            'start_time' => $current_time,
            'next_due_date' => $current_date,
        ])->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get();

        $monthly->map(function ($_campaign) use ($date) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->get();
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            if ($_campaign->template == 'template1') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template1_message' => $_campaign->template1_message,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate1')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 2
            if ($_campaign->template == 'template2') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job 
                    ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template2_message' => $_campaign->template2_message,
                        'template2_file' => $_campaign->template2_file,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate2')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 3
            if ($_campaign->template == 'template3') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template3_header' => $_campaign->template3_header,
                        'template3_message' => $_campaign->template3_message,
                        'template3_footer' => $_campaign->template3_footer,
                        'template3_link_url' => $_campaign->template3_link_url,
                        'template3_link_cta' => $_campaign->template3_link_cta,
                        'template3_phone_number' => $_campaign->template3_phone_number,
                        'template3_phone_cta' => $_campaign->template3_phone_cta,
                        'wa_campaign_id' => $_campaign->id
                    ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // update the campaign queue to waiting
            WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
                'status' => 'Waiting'
            ]);

            // update next_due_date
            WaCampaigns::where(['id' => $_campaign->id])->update([
                'next_due_date' => $date->addYears(1)->format('Y-m-d')
            ]);
        });
    }

    public function customHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $custom = WaCampaigns::where([
            'frequency_cycle' => 'custom',
            'message_timing' => 'Schedule',
            'start_time' => $current_time,
            'next_due_date' => $current_date,
        ])->whereDate('start_date', '<=', $current_date)->whereDate('end_date', '>=', $current_date)->get();

        $custom->map(function ($_campaign) use ($date) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->get();
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and 
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            if ($_campaign->template == 'template1') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate1BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template1_message' => $_campaign->template1_message,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate1')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 2
            if ($_campaign->template == 'template2') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job 
                    ProcessTemplate2BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template2_message' => $_campaign->template2_message,
                        'template2_file' => $_campaign->template2_file,
                        'wa_campaign_id' => $_campaign->id
                    ])->onQueue('waTemplate2')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // template 3
            if ($_campaign->template == 'template3') {
                // dispatch job and delay
                foreach ($chunks as $key => $_chunk) {
                    // dispatch job
                    ProcessTemplate3BulkWAMessages::dispatch($_chunk, [
                        'whatsapp_account' => $whatsapp_number->phone_number,
                        'full_jwt_session' => $whatsapp_number->full_jwt_session,
                        'template3_header' => $_campaign->template3_header,
                        'template3_message' => $_campaign->template3_message,
                        'template3_footer' => $_campaign->template3_footer,
                        'template3_link_url' => $_campaign->template3_link_url,
                        'template3_link_cta' => $_campaign->template3_link_cta,
                        'template3_phone_number' => $_campaign->template3_phone_number,
                        'template3_phone_cta' => $_campaign->template3_phone_cta,
                        'wa_campaign_id' => $_campaign->id
                    ])->afterCommit()->onQueue('waTemplate3')->delay($delay);

                    $delay += mt_rand(10, 20);
                }
            }

            // update the campaign queue to waiting
            WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
                'status' => 'Waiting'
            ]);

            // update next_due_date
            // 
            if ($_campaign->frequency_unit == 'day') {
                WaCampaigns::where(['id' => $_campaign->id])->update([
                    'next_due_date' => $date->addDays($_campaign->frequency_amount)->format('Y-m-d')
                ]);
            }

            if ($_campaign->frequency_unit == 'week') {
                WaCampaigns::where(['id' => $_campaign->id])->update([
                    'next_due_date' => $date->addWeeks($_campaign->frequency_amount)->format('Y-m-d')
                ]);
            }

            if ($_campaign->frequency_unit == 'month') {
                WaCampaigns::where(['id' => $_campaign->id])->update([
                    'next_due_date' => $date->addMonths($_campaign->frequency_amount)->format('Y-m-d')
                ]);
            }

            if ($_campaign->frequency_unit == 'year') {
                WaCampaigns::where(['id' => $_campaign->id])->update([
                    'next_due_date' => $date->addYears($_campaign->frequency_amount)->format('Y-m-d')
                ]);
            }
        });
    }
}
