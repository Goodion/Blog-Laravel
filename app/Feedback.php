<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $guarded = ['id'];

    protected $table = 'feedbacks';

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            \Cache::tags(['skillbox_laravel_feedbacks'])->flush();
        });

        static::updated(function () {
            \Cache::tags(['skillbox_laravel_feedbacks'])->flush();
        });

        static::deleted(function () {
            \Cache::tags(['skillbox_laravel_feedbacks'])->flush();
        });
    }
}
