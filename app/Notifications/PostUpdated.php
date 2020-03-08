<?php

namespace App\Notifications;

use App\Post;
use App\Service\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostUpdated extends PostEvent
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.post-updated', ['post' => $this->post])
                ->subject('Статья изменена.');
    }

    public function toTelegram($notifiable)
    {
        return 'Изменена статья ' . $this->post['title'];
    }
}
