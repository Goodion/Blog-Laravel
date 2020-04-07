<?php


namespace App;


trait HasCache
{
    public static function bootHasCache()
    {
        static::created(function () {
            \Cache::tags(['skillbox_laravel_news', 'skillbox_laravel_tags', 'skillbox_laravel_posts'])->flush();
        });

        static::updated(function () {
            \Cache::tags(['skillbox_laravel_news', 'skillbox_laravel_tags', 'skillbox_laravel_posts'])->flush();
        });

        static::deleted(function () {
            \Cache::tags(['skillbox_laravel_news', 'skillbox_laravel_tags', 'skillbox_laravel_posts'])->flush();
        });
    }
}
