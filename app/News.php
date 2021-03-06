<?php

namespace App;

use App\HasCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class News extends Model
{
    use HasCache;

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
}
