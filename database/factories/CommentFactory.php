<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $commentable = [
        \App\Post::class,
        \App\News::class,
    ];
    $commentableType = $faker->randomElement($commentable);
    $commentable = factory($commentableType)->create();

    return [
        'commentable_type' => $commentableType,
        'commentable_id' => $commentable->id,
        'comment' => $faker->sentences(2, true),
        'author_id' => factory(User::class),
    ];
});
