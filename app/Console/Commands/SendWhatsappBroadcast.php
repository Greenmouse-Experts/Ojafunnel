<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\WhatsappNumber;
use App\Jobs\ProcessBroadcastWAMessages;
use App\Models\BirthdayContact;
use Illuminate\Console\Command;
use App\Models\BirthdayAutomation;
use Illuminate\Support\Facades\Log;
use App\Models\ListManagementContact;
use App\Models\WhatappBroadcast;

class SendWhatsappBroadcast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wabroadcast:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for broadcast messages through whatsapp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();

        $date = date('Y-m-d');
        $time = date('h:i:s');


        $broadcasts = WhatappBroadcast::where('date', $date)
            ->where('time', $time)
            ->get();

        $broadcasts->map(function ($_campaign) use ($date, $time) {
            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->sender_id])->first();


            $lists = ListManagementContact::where(['list_management_id' => $_campaign->list_mgt_id])->where('subscribe', true)
                ->get();

                // echo json_encode($lists);

            // divide into 10 chunks and
            // delay each job between 10  - 20 sec in the queue
            $chunks = $lists->chunk(10);
            $delay = mt_rand(10, 20);

            // template 1
            // dispatch job and delay
            foreach ($chunks as $key => $_chunk) {
                
                // dispatch job
                ProcessBroadcastWAMessages::dispatch($_chunk, [
                    'whatsapp_account' => $whatsapp_number->phone_number,
                    'full_jwt_session' => $whatsapp_number->full_jwt_session,
                    'template1_message' => $_campaign->message, //$_campaign->template1_message,
                    'wa_campaign_id' => $_campaign->id,
                    'series_id' => $_campaign->id
                ])->onQueue('waTemplate1')->delay($delay);

                $delay += mt_rand(10, 20);
            }

        });

        return Command::SUCCESS;
    }
}
