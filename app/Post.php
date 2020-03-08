<?php

namespace App;

use App\Mail\PostEventMailNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        return $this->belongsToMany(Tag::class);
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
        return new Class($models) extends Collection
        {
            public function allPublished()
            {
                return $this->filter->isPublished();
            }
        };
    }

    public function publishedInPeriod($dateFrom, $DateTo)
    {
        return $this->whereBetween('created_at', [$dateFrom, $DateTo])->get()->allPublished();
    }

    public function scopeCurrentAuthor($query)
    {
        return $query->where('author_id', '=', auth()->id());
    }
}
