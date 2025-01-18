<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisasterNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($subject, $content, $attachments = [])
    {
        $this->emailData = [
            'subject' => $subject,
            'content' => $content,
            'attachments' => $attachments
        ];
    }

    public function build()
    {
        $mail = $this->subject($this->emailData['subject'])
            ->view('emails.disaster-notification', [
                'emailSubject' => $this->emailData['subject'],
                'emailContent' => $this->emailData['content']
            ]);

        if (!empty($this->emailData['attachments'])) {
            foreach ($this->emailData['attachments'] as $attachment) {
                if (file_exists($attachment)) {
                    $mail->attach($attachment);
                }
            }
        }

        return $mail;
    }
}