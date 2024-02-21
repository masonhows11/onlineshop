<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAuthNotificationQueue extends Notification implements ShouldQueue
{
    use Queueable;
    protected  $user;

    /**
     * Create a new notification instance.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        return (new MailMessage)
            ->subject('گرافیک شاپ')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->greeting('کد فعال سازی')
            ->line('کاربر عزیز')
            ->line($this->user->email)
            ->line('کد فعال سازی')
            ->line( $this->user->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
