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
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public static function TagsCloud()
    {
        return \Cache::tags(['skillbox_laravel_tags'])->remember('tagsCloud', 3600*24, function () {
            return (new static)->has('posts')->orHas('news')->get();
        });
    }
}
