<?php

namespace App\Notifications\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
    }
    public function toMail($notifiable)
    {
        $data = $this->data;
        return (new MailMessage)
            ->subject('Konfirmasi Reset Password')
            ->view('pages.web.auth.reset_notif',compact('notifiable','data'));
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
