<?php

namespace App\Notifications;

use App\Models\User;
use Grosv\LaravelPasswordlessLogin\LoginUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SendMagicLinkNotification extends Notification
{
    use Queueable;
    private $new_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $new_user)
    {
        $this->new_user = $new_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $generator = new LoginUrl($notifiable);
        $generator->setRedirectUrl($this->new_user->username.'/dashboard');
        $url = $generator->generate();

        $urls = env('APP_URL')."/magic-login-link/".sha1($this->new_user->id)."?expires=1654454567";

        //https://ojafunnel.com/magic-login/17?expires=1692683844&redirect_to=chinny%2Fdashboard&user_type=app-models-user&signature=ea52ff361c44f7756aae998e5e3926ba5890fd7ee85420400eb29a17b5394d12

        return (new MailMessage)
                    ->subject('Your Login Magic Link!')
                    ->line('Click this link to log in!')
                    ->action('Login', $urls)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
