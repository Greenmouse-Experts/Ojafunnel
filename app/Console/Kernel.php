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
use App\Console\Commands\SendScheduledSeriesSms;
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
        SendScheduledSeriesSms::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run SMS campaigns and reminders every minute
        $schedule->command('smsCampaign:run')->everyMinute()->withoutOverlapping();
        $schedule->command('subscription:cron')->dailyAt('00:30')->withoutOverlapping();
        $schedule->command('subscriptionReminder:cron')->dailyAt('05:30')->withoutOverlapping();

        // Run WhatsApp and email campaigns every minute
        $schedule->command('sendwabulk:run')->everyMinute()->withoutOverlapping();
        $schedule->command('emailcampaign:run')->everyMinute()->withoutOverlapping();

        // Run birthday and anniversary campaigns daily
        $schedule->command('wabirthday:run')->daily()->withoutOverlapping();
        $schedule->command('emailbirthday:run')->daily()->withoutOverlapping();
        $schedule->command('smsBirthday:cron')->daily()->withoutOverlapping();
        $schedule->command('sms_cart_reminder:run')->daily()->withoutOverlapping();

        // Run SSL generation and renewal every thirty minutes
        $schedule->command('generatessl:run')->everyThirtyMinutes()->withoutOverlapping();
        $schedule->command('renewssl:run')->daily()->withoutOverlapping();

        // Run series campaigns every minute
        $schedule->command('smsSeriesCampaign:run')->hourly()->withoutOverlapping();
        $schedule->command('sendwaseries:run')->hourly()->withoutOverlapping();
        $schedule->command('sendwaserieslater:run')->hourly()->withoutOverlapping();
        $schedule->command('seriesEmailcampaign:run')->hourly()->withoutOverlapping();
        $schedule->command('send:scheduled-series-sms')->everyMinute()->withoutOverlapping();
        $schedule->command('sendwascheduledseries:run')->hourly()->withoutOverlapping();

        // Log a message indicating the cron job is working
        // $schedule->call(function () {
        //     Log::info('Cron job is working!');
        // })->everyMinute();
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
