<?php

namespace App\Console;

use App\Console\Commands\EmailBirthday;
use App\Console\Commands\GenerateSSL;
use App\Console\Commands\RenewSSL;
use App\Console\Commands\SendEmailCampaign;
use App\Console\Commands\SendSms;
use App\Console\Commands\SendWABulk;
use App\Console\Commands\SendWASeries;
use App\Console\Commands\SendWASeriesLater;
use App\Console\Commands\WABirthday;
use App\Console\Commands\SmsBirthday;
use App\Console\Commands\Subscription;
use App\Console\Commands\EmailCartReminder;
use App\Console\Commands\SeriesSMS;
use App\Console\Commands\SubscriptionReminder;
use App\Console\Commands\SeriesEmailCampaign;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendSms::class,
        SeriesSMS::class,
        SendWABulk::class,
        SendWASeries::class,
        SendWASeriesLater::class,
        SmsBirthday::class,
        Subscription::class,
        SubscriptionReminder::class,
        WABirthday::class,
        EmailBirthday::class,
        EmailCartReminder::class,
        SendEmailCampaign::class,
        GenerateSSL::class,
        RenewSSL::class,
        SeriesEmailCampaign::class,
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
        $schedule->command('smsCampaign:run')->everyMinute()->withoutOverlapping();
        $schedule->command('smsBirthday:cron')->everyMinute()->withoutOverlapping();
        $schedule->command('subscription:cron')->dailyAt('00:30')->withoutOverlapping();
        $schedule->command('subscriptionReminder:cron')->dailyAt('05:30')->withoutOverlapping();

        // run command every minute
        $schedule->command('sendwabulk:run')->everyMinute()->withoutOverlapping();
        $schedule->command('emailcampaign:run')->everyMinute()->withoutOverlapping();

        // run command every day
        // birthday or anniversary
        $schedule->command('wabirthday:run')->everyMinute()->withoutOverlapping();
        $schedule->command('emailbirthday:run')->everyMinute()->withoutOverlapping();
        $schedule->command('sms_cart_reminder:run')->daily()->withoutOverlapping();

        // ssl
        $schedule->command('generatessl:run')->everyThirtyMinutes()->withoutOverlapping();
        $schedule->command('renewssl:run')->daily()->withoutOverlapping();

        // series
        $schedule->command('smsSeriesCampaign:run')->everyMinute()->withoutOverlapping();
        $schedule->command('sendwaseries:run')->everyMinute()->withoutOverlapping();
        $schedule->command('sendwaserieslater:run')->everyMinute()->withoutOverlapping();
        $schedule->command('seriesEmailcampaign:run')->everyMinute()->withoutOverlapping();

        // Log a message indicating the cron job is working
        $schedule->call(function () {
            Log::info('Cron job is working!');
        })->everyMinute()->withoutOverlapping();
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
