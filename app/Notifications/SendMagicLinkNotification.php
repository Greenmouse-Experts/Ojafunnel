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

        return (new MailMessage)
                    ->subject('Your Login Magic Link!')
                    ->line('Click this link to log in!')
                    ->action('Login', $url)
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
