<?php

namespace App;

use App\Mail\PostEventMailNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'author_id');
    }

    public function getRoutekeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeUnpublish($query)
    {
        return $query->where('published', 0);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
