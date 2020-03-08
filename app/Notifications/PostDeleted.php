<?php

namespace App\Notifications;

use App\Post;
use App\Service\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostDeleted extends PostEvent
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.post-deleted', ['post' => $this->post])
                ->subject('Удалена статья.');
    }

    public function toTelegram($notifiable)
    {
        return 'Удалена статья ' . $this->post['title'];
    }
}
