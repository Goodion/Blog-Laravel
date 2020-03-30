<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function post()
    {
        return $this->belongsTo(\App\Post::class);
    }
}
