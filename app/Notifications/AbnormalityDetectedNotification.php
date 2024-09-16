<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbnormalityDetectedNotification extends Notification
{
    use Queueable;

    protected $notifications;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->notifications = $data;
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
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Abormality Detected')
            ->view('mail.abnormal-detected', ['notifications' => $this->notifications]);
    }
}
