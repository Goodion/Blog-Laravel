<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags(['skillbox_laravel_comments'])->flush();
        });

        static::updated(function () {
            \Cache::tags(['skillbox_laravel_comments'])->flush();
        });

        static::deleted(function () {
            \Cache::tags(['skillbox_laravel_comments'])->flush();
        });
    }
}
