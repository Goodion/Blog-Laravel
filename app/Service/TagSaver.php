<?php


namespace App\Service;


use App\Tag;

class TagSaver
{
    public function store($instance, $tags)
    {
        $instanceTags = $instance->tags->keyBy('name');

        $tagsToAttach = $tags->diffKeys($instanceTags);
        $tagsToDetach = $instanceTags->diffKeys($tags);

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $instance->tags()->attach($tag);
        }

        foreach ($tagsToDetach as $tag) {
            $instance->tags()->detach($tag);
        }
    }
}
