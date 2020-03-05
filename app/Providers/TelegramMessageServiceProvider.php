<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TelegramMessageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $data = collect([
            'token' => config('config.telegramMessage.token'),
            'admin_chatid' => config('config.telegramMessage.admin_chatid'),
            'curlopt_proxy' => config('config.telegramMessage.curlopt_proxy'),
            'curlopt_proxyuserpwd' => config('config.telegramMessage.curlopt_proxyuserpwd'),
        ]);

        $this->app->singleton(\App\Service\TelegramMessage::class, function () use ($data) {
            return new \App\Service\TelegramMessage($data);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
