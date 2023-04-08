<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpiryReminderMail;
use App\Models\OjaPlan;
use Illuminate\Console\Command;
use App\Models\OjaSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SubscriptionReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptionReminder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind User of the subscription, when it is about to expire.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribers = OjaSubscription::where('status', 'Active')->get();

        // \Log::info(now()->subDays(3)->toDateString());

        foreach($subscribers as $subscribe)
        {
            if(date('Y-m-d', strtotime($subscribe->expiry_notify_at)) == Carbon::today()->toDateString())
            {
                $user = User::find($subscribe->user_id);
                $plan = OjaPlan::find($subscribe->plan_id);

                Mail::to($user->email)->send(new SubscriptionExpiryReminderMail($user, $subscribe, $plan));
            }
        }

        return Command::SUCCESS;
    }
}
