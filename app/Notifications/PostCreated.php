<?php

namespace App\Notifications;

use App\Post;
use App\Providers\TelegramMessageServiceProvider;
use App\Service\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreated extends PostEvent
{
     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.post-created', ['post' => $this->post])
                    ->subject('Добавлена новая статья.');
    }

    public function toTelegram($notifiable)
    {
        return 'Создана статья ' . $this->post['title'];
    }
}
