<?php

namespace App\Providers;

use App\Models\TwilioIntegration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class SmsAutomationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Auth::user())
        {
            // $usertwilioDetail = TwilioIntegration::where('user_id', Auth::user()->id)->first();

            // if(!$usertwilioDetail->isEmpty())
            // {
                $this->app['config']->set('sms.drivers.twilio.sid', 'Man');
                // $this->app['config']->set('sms.drivers.twilio.token', $usertwilioDetail->token);
                // $this->app['config']->set('sms.drivers.twilio.from', $usertwilioDetail->from);
            // }
        }
    }
}
