<?php

namespace App\Console;

use App\Console\Commands\SendSms;
use App\Console\Commands\SendWABulk;
use App\Console\Commands\SmsBirthday;
use App\Console\Commands\Subscription;
use App\Console\Commands\SubscriptionReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendSms::class,
        SendWABulk::class,
        SmsBirthday::class,
        Subscription::class,
        SubscriptionReminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('smsCampaign:run')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('smsBirthday:cron')->dailyAt('00:30')->withoutOverlapping();
        $schedule->command('subscription:cron')->dailyAt('00:30')->withoutOverlapping();
        $schedule->command('subscriptionReminder:cron')->dailyAt('05:30')->withoutOverlapping();

        // run command every minute
        $schedule->command('sendwabulk:run')->everyMinute()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
