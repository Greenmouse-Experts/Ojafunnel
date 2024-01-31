<?php

namespace App\Observers;

use App\Models\ListManagementContact;
use App\Models\WaCampaigns;
use App\Models\SeriesWaCampaign;
use App\Models\CandidateWASeries;
use Carbon\Carbon;

class ListContactObserver
{
    /**
     * Handle the ListManagementContact "created" event.
     *
     * @param  \App\Models\ListManagementContact  $listManagementContact
     * @return void
     */
    public function created(ListManagementContact $listManagementContact)
    {
        /*
        // check if list_mgt_id is tied to any wa campaign;
        $campaign = WaCampaigns::where('contact_list_id', $listManagementContact->list_management_id)
            ->orderBy('id', 'DESC') // Filter the last campaign ran
            ->first();

        if(is_null($campaign)) {return;}

        // with the following detail @ hand; you can proceed to restart a fresh series campaign
        // for the newly added candidate.
        $wa_series = SeriesWaCampaign::where(['wa_campaign_id' => $campaign->id])->get();

        $old_dates = SeriesWaCampaign::where(['wa_campaign_id' => $campaign->id])->pluck('date')->toArray();
        $old_times = SeriesWaCampaign::where(['wa_campaign_id' => $campaign->id])->pluck('time')->toArray();
        $last_created_series = null;

        $index = 0;

        foreach ($wa_series as $item) 
        {
            $now = Carbon::now();

            if($index == 0) 
            {
                // add 1hr to kick time
                $date = Carbon::parse($now)->addHour();
                $last_created_series = CandidateWASeries::create([
                    'user_id' => $item->user_id,
                    'wa_campaign_id' => $campaign->id,
                    'date' => $date->format('Y-m-d'),
                    'time' => $date->format('h:i:s'),
                    'message' => $item->message,
                    'contact_count' => 1,
                    'delivered_count' => 0,
                    'status' => 'Waiting'
                ]);
            } else {
                $last_date = $last_created_series->date;
                $last_old_date = new Carbon($old_dates[$index - 1]);
                $curr_old_date = new Carbon($old_dates[$index]);

                $getintvl = $last_old_date->diffInDays($curr_old_date);
                $new_date = Carbon::parse($last_date)->addDays($getintvl)->format('Y-m-d');

                $last_created_series = CandidateWASeries::create([
                    'user_id' => $item->user_id,
                    'wa_campaign_id' => $campaign->id,
                    'date' => $date->format('Y-m-d'),
                    'time' => $new_date,
                    'message' => $item->message,
                    'contact_count' => 1,
                    'delivered_count' => 0,
                    'status' => 'Waiting'
                ]);
            }
            

            $index++;
        } */
    }

    /**
     * Handle the ListManagementContact "updated" event.
     *
     * @param  \App\Models\ListManagementContact  $listManagementContact
     * @return void
     */
    public function updated(ListManagementContact $listManagementContact)
    {
        //
    }

    /**
     * Handle the ListManagementContact "deleted" event.
     *
     * @param  \App\Models\ListManagementContact  $listManagementContact
     * @return void
     */
    public function deleted(ListManagementContact $listManagementContact)
    {
        //
    }

    /**
     * Handle the ListManagementContact "restored" event.
     *
     * @param  \App\Models\ListManagementContact  $listManagementContact
     * @return void
     */
    public function restored(ListManagementContact $listManagementContact)
    {
        //
    }

    /**
     * Handle the ListManagementContact "force deleted" event.
     *
     * @param  \App\Models\ListManagementContact  $listManagementContact
     * @return void
     */
    public function forceDeleted(ListManagementContact $listManagementContact)
    {
        //
    }
}
