<?php

namespace App\Notifications;

use App\Post;
use App\Service\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostUpdated extends PostEvent
{
    public function via($notifiable)
    {
        return ['mail', TelegramMessage::class, 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.post-updated', ['post' => $this->post])
                ->subject('Статья изменена.');
    }

    public function toTelegram($notifiable)
    {
        return 'Изменена статья ' . $this->post['title'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'url' => url("/posts/{$this->post->slug}"),
            'title' => $this->post->title,
            'changes' => array_keys($this->post->getChanges())
        ]);
    }
}
