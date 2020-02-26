<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getRoutekeyName()
    {
        return 'slug';
    }

    public function scopeUnpublish($query)
    {
        return $query->where('published', 0);
    }
}
