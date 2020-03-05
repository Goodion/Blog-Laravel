<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->words(5, true);
    $slug = Str::slug($title, '_');

    return [
        'title' => $title,
        'body' => $faker->sentences(6, true),
        'description' => $faker->sentence(),
        'published' => $faker->boolean,
        'slug' => $slug,
        'files' => null,
        'author_id' => $faker->name,
    ];
});
