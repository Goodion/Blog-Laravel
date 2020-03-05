<?php

return [

    'admin_email' => env('ADMIN_EMAIL'),
    'admin_password' => password_hash(env('ADMIN_PASSWORD'), PASSWORD_DEFAULT),

    'telegramMessage' => [
        'token' => env('TELEGRAM_TOKEN'),
        'admin_chatid' => env('TELEGRAM_ADMIN_CHATID'),
        'curlopt_proxy' => env('CURLOPT_PROXY'),
        'curlopt_proxyuserpwd' => env('CURLOPT_PROXYUSERPWD'),
    ],

];
