<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientSubscribedNotification extends Notification
{
    use Queueable;

    public $subscription;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
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
        return (new MailMessage)
                    ->line('Dear Mr.' . $notifiable->name)
                    ->line('You subscribed successfully with us and your subscription id is ' . $this->subscription->id)
                    ->line('The following are your credentials, please use them to login to our system')
                    ->line('Email: ' . $notifiable->email)
                    ->line('Password: password')
                    ->line('We strongly suggest you change your password once you are logged in as this is the default password and is given to all new subscribers')
                    ->action('Login to our system', url('https://earsna.com'))
                    ->line('Thank you for subscribing with us!');
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
