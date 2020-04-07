<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class PostsCollection extends Collection
{
    public function allPublished()
    {
        return $this->filter->isPublished();
    }
}
