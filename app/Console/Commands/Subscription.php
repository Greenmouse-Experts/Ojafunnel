<?php

namespace App\Console\Commands;

use App\Models\OjaSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Subscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription due date and stop service';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriptions = OjaSubscription::where('status', 'Active')->get();

        // \Log::info(Carbon::today()->toDateString());

        foreach($subscriptions as $sub)
        {
            if(date('Y-m-d', strtotime($sub->ends_at)) == Carbon::today()->toDateString())
            {
                 $sub->update([
                    'status' => 'Expired'
                ]);

                $user = User::find($sub->user_id);

                $user->update([
                    'plan' => 1
                ]);
            }
           
        }
        return Command::SUCCESS;
    }
}
