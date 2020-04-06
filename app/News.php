<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class News extends Model
{
    public $guarded = [];

    public function getRoutekeyName()
    {
        return 'id';
    }

    public function tags()
    {
        return $this->morphToMany(\App\Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(\App\Comment::class, 'commentable');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags(['skillbox_laravel_news', 'skillbox_laravel_tags'])->flush();
        });

        static::updated(function () {
            \Cache::tags(['skillbox_laravel_news', 'skillbox_laravel_tags'])->flush();
        });

        static::deleted(function () {
            \Cache::tags(['skillbox_laravel_news', 'skillbox_laravel_tags'])->flush();
        });
    }
}
