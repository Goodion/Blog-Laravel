<?php

namespace App\Service;

use Illuminate\Notifications\Notification;

class TelegramMessage
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function send($notifiable, Notification $notification)
    {
        $text = $notification->toTelegram($notifiable);

        $ch = curl_init();

        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . $this->data->get('token') . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => $this->data->get('admin_chatid'),
                    'text' => $text,
                ),
                CURLOPT_PROXY => $this->data->get('curlopt_proxy'),
                CURLOPT_PROXYUSERPWD => $this->data->get('curlopt_proxyuserpwd'),
                CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
                CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
            )
        );

        curl_exec($ch);
    }
}
