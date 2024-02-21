<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminLoginNotification extends Notification
{
    use Queueable;

    public $admin;
    public $token;
    /**
     * Create a new notification instance.
     */
    public function __construct($admin,$token)
    {
        $this->admin = $admin;
        $this->token = $token;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('گرافیک شاپ تاییدیه ورود پنل مدیریت')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->greeting('graphicshop.ir')
            ->line('Dear User')
            ->line('admin panel active token for admin user :')
            ->line("admin: $this->admin")
            ->line("active token : $this->token");
    //        return (new MailMessage)
    //                    ->line('The introduction to the notification.')
    //                    ->action('Notification Action', url('/'))
    //                    ->line('Thank you for using our application!');
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
