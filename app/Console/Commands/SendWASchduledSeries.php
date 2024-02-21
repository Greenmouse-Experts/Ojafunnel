<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\WaQueues;
use App\Models\WaCampaigns;
use App\Models\SeriesWaCampaign;
use App\Models\WhatsappNumber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\ListManagementContact;
use App\Jobs\ProcessTemplate1BulkWAMessages;
use App\Jobs\ProcessTemplate2BulkWAMessages;
use App\Jobs\ProcessTemplate3BulkWAMessages;
use App\Models\SentWhatsappSeriesMessage;
use Illuminate\Database\Eloquent\Collection;

class SendWASchduledSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendwascheduledseries:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks for due whatsapp series and send';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();

        $seriesIJ = SeriesWaCampaign::where('type', 'immediately_joined')->get();

        $seriesSDJ = SeriesWaCampaign::where('type', 'sameday_joined')->get();

        $count = 1;

        foreach($seriesIJ as $element)
        {
            // Parse the date and time strings into Carbon instances
            $dateCarbon = Carbon::parse($element->date);
            $timeCarbon = Carbon::parse($element->time);

            // Combine the date and time
            $combinedDateTime = $dateCarbon->format('Y-m-d') . ' ' . $timeCarbon->format('H:i:s');

            // Parse the combined date and time string into a Carbon instance
            $combinedCarbon = Carbon::parse($combinedDateTime);

            $_campaign = WaCampaigns::find($element->wa_campaign_id);
            $contacts = ListManagementContact::latest()
                ->where('list_management_id', $_campaign->contact_list_id)
                ->where('created_at', '>=', $combinedCarbon->subMinutes(15))
                ->where('subscribe', true)
                ->select('id', 'phone', 'name', 'created_at')
                ->get();

            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts;
            $delay = mt_rand(10, 20);

            foreach ($chunks as $key => $_chunk) {
                // Check if the message has already been sent to this contact
                if (!$this->messageSent($element, $_chunk, $element->type)) {
                    // Send the Whatsapp message
                    $contactsCollection = new Collection($contacts);
                    if ($_campaign->template == 'template1') {
                        // dispatch job and delay
                        ProcessTemplate1BulkWAMessages::dispatch($contactsCollection, [
                            'whatsapp_account' => $whatsapp_number->phone_number,
                            'full_jwt_session' => $whatsapp_number->full_jwt_session,
                            'template1_message' => $element->message, //$_campaign->template1_message,
                            'wa_campaign_id' => $_campaign->id,
                            'series_id' => $element->id
                        ])->onQueue('waTemplate1')->delay($delay);

                        $delay += mt_rand(10, 20);

                        // Log or handle the message sending process
                        $this->logMessageSent($element, $_chunk, $element->type);
                    }

                    // template 2
                    if ($_campaign->template == 'template2') {
                        // dispatch job
                        ProcessTemplate2BulkWAMessages::dispatch($contactsCollection, [
                            'whatsapp_account' => $whatsapp_number->phone_number,
                            'full_jwt_session' => $whatsapp_number->full_jwt_session,
                            'template2_message' => $_campaign->template2_message,
                            'template2_file' => $_campaign->template2_file,
                            'wa_campaign_id' => $_campaign->id
                        ])->onQueue('waTemplate2')->delay($delay);

                        $delay += mt_rand(10, 20);

                        // Log or handle the message sending process
                        $this->logMessageSent($element, $_chunk, $element->type);
                    }

                    // template 3
                    if ($_campaign->template == 'template3') {
                        // dispatch job
                        ProcessTemplate3BulkWAMessages::dispatch($contactsCollection, [
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

                        // Log or handle the message sending process
                        $this->logMessageSent($element, $_chunk, $element->type);
                    }
                }
            }

            // update the campaign queue to waiting
            // WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
            //     'status' => 'Waiting'
            // ]);
        }


        foreach($seriesSDJ as $element)
        {
            // Parse the date and time strings into Carbon instances
            $dateCarbon = Carbon::parse($element->date);

            $_campaign = WaCampaigns::find($element->wa_campaign_id);
            $contacts = ListManagementContact::latest()
                ->where('list_management_id', $_campaign->contact_list_id)
                ->where('created_at', '>=', $dateCarbon->toDateString())
                ->where('subscribe', true)
                ->whereNotNull('phone')
                ->select('id', 'phone', 'name', 'created_at')
                ->get();

            $whatsapp_number = WhatsappNumber::where(['user_id' => $_campaign->user_id, 'phone_number' => $_campaign->whatsapp_account])->first();

            // divide into 10 chunks and
            // delay each job between 10  - 20 sec in the queue
            $chunks = $contacts;
            $delay = mt_rand(10, 20);

            foreach ($chunks as $key => $_chunk) {
                // Check if the message has already been sent to this contact
                if (!$this->messageSent($element, $_chunk, $element->type)) {
                    // Send the Whatsapp message
                    $contactsCollection = new Collection($contacts);
                    if ($_campaign->template == 'template1') {
                        // dispatch job
                        ProcessTemplate1BulkWAMessages::dispatch($contactsCollection, [
                            'whatsapp_account' => $whatsapp_number->phone_number,
                            'full_jwt_session' => $whatsapp_number->full_jwt_session,
                            'template1_message' => $element->message, //$_campaign->template1_message,
                            'wa_campaign_id' => $_campaign->id,
                            'series_id' => $element->id
                        ])->onQueue('waTemplate1')->delay($delay);

                        $delay += mt_rand(10, 20);

                        // Log or handle the message sending process
                        $this->logMessageSent($element, $_chunk, $element->type);
                    }

                    // template 2
                    if ($_campaign->template == 'template2') {
                        // dispatch job
                        ProcessTemplate2BulkWAMessages::dispatch($contactsCollection, [
                            'whatsapp_account' => $whatsapp_number->phone_number,
                            'full_jwt_session' => $whatsapp_number->full_jwt_session,
                            'template2_message' => $_campaign->template2_message,
                            'template2_file' => $_campaign->template2_file,
                            'wa_campaign_id' => $_campaign->id
                        ])->onQueue('waTemplate2')->delay($delay);

                        $delay += mt_rand(10, 20);

                        // Log or handle the message sending process
                        $this->logMessageSent($element, $_chunk, $element->type);
                    }

                    // template 3
                    if ($_campaign->template == 'template3') {
                        // dispatch job
                        ProcessTemplate3BulkWAMessages::dispatch($contactsCollection, [
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

                        // Log or handle the message sending process
                        $this->logMessageSent($element, $_chunk, $element->type);
                    }
                }
            }

            // update the campaign queue to waiting
            // WaQueues::where(['wa_campaign_id' => $_campaign->id])->update([
            //     'status' => 'Waiting'
            // ]);
        }


        return Command::SUCCESS;
    }


    // Check if the message has already been sent to this contact
    protected function messageSent($whatsapp, $contact, $type)
    {
        // Query the SentMessage table to check if there is a record for this whatsapp campaign and contact
        return SentWhatsappSeriesMessage::where('whatapp_campaign_id', $whatsapp->id)
            ->where('contact_id', $contact->id)
            ->where('type', $type)
            ->exists();
    }

    public function oneTimeHandler()
    {
        $date = Carbon::now();

        $current_date = $date->format('Y-m-d');
        $current_time = $date->format('H:i');

        $onetime = WaCampaigns::where([
            'frequency_cycle' => 'onetime',
            'message_timing' => 'Series',
            // 'start_time' => $current_time,
            // 'next_due_date' => $current_date,
        ])->get();

        // Log::info(json_encode($onetime));

        $onetime->map(function ($_campaign) {
            $contacts = ListManagementContact::latest()->where('list_management_id', $_campaign->contact_list_id)->where('subscribe', true)->whereNotNull('phone')->get();
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


        });
    }

    // Log the message sending process
    protected function logMessageSent($whatsapp, $contact, $day)
    {
        // Create a new record in the SentMessage table to mark that the message has been sent
        SentWhatsappSeriesMessage::create([
            'whatapp_campaign_id' => $whatsapp->id,
            'contact_id' => $contact->id,
            'type' => $day, // Or the actual timestamp when the message was sent
        ]);
    }

}
