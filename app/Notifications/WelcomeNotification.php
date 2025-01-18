<?php

namespace App\Notifications;

use App\Traits\SendSmsMessageTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable, SendSmsMessageTrait;

    public $owner;
    /**
     * Create a new notification instance.
     */
    public function __construct($owner)
    {
        $this->owner = $owner;
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
            ->subject('أهلاً وسهلاً بك في موقع حصر الأضرار')
            ->from('info@nameer-graduation.com', 'علوم بلس')
            ->view('mail.welcome_greeting', [
                    'data' => $this->owner,
                    'message' =>  'شكراً لك على تسجيلك في منصة حصر الأضرار'
                ]
            );
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
