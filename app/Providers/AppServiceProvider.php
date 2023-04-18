<?php

namespace App\Providers;

use Illuminate\Mail\Mailer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Transport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // custom user mailer
        $this->app->bind('user.mailer', function ($app, $parameters) {
            $smtp_host = Arr::get($parameters, 'smtp_host');
            $smtp_port = Arr::get($parameters, 'smtp_port');
            $smtp_username = Arr::get($parameters, 'smtp_username');
            $smtp_password = Arr::get($parameters, 'smtp_password');
            $from_email = Arr::get($parameters, 'from_email');
            $from_name = Arr::get($parameters, 'from_name');

            $transport = Transport::fromDsn(
                'smtp://' . urlencode($smtp_username) . ':' . urlencode($smtp_password) . '@' . urlencode($smtp_host)  . ':' . $smtp_port
            );

            $mailer = new Mailer('user.mailer', $app->get('view'), $transport, $app->get('events'));
            $mailer->alwaysFrom($from_email, $from_name);
            // $mailer->alwaysReplyTo($from_email, $from_name);

            return $mailer;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // for https in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
