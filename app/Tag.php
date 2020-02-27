<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function getRoutekeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function deleteIfNotUsed()
    {
        if ($this->posts()->first() == null) {
            $this->delete();
        }
    }
}
