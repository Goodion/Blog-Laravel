<?php

namespace App;

use App\Mail\PostEventMailNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use PhpParser\Builder\Class_;

class Post extends Model
{
    public $guarded = [];

    public function getRoutekeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->morphToMany(\App\Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(\App\Comment::class, 'commentable');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function isPublished()
    {
        return (bool) $this->published;
    }

    public function newCollection(array $models =[])
    {
        return new PostsCollection($models);
    }

    public function publishedInPeriod($dateFrom, $DateTo)
    {
        return $this->whereBetween('created_at', [$dateFrom, $DateTo])->get()->allPublished();
    }

    public function scopeCurrentAuthor($query)
    {
        return $query->where('author_id', '=', auth()->id());
    }

    public function history()
    {
        return $this->belongsToMany(\App\User::class, 'post_histories')->withPivot(['before', 'after'])->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function (Post $post) {

            $after = $post->getDirty();
            $post->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($post->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after),
            ]);
        });

        static::created(function () {
            \Cache::tags(['skillbox_laravel_posts', 'skillbox_laravel_tags'])->flush();
        });

        static::updated(function () {
            \Cache::tags(['skillbox_laravel_posts', 'skillbox_laravel_tags'])->flush();
        });

        static::deleted(function () {
            \Cache::tags(['skillbox_laravel_posts', 'skillbox_laravel_tags'])->flush();
        });
    }
}
