<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Post::class, 10)->create(
                ['author_id' => factory(App\User::class)->create()->id]
        );

        factory(\App\Post::class, 10)->create(
            ['author_id' => factory(App\User::class)->create()->id]
        );

        factory(\App\Tag::class, 7)->create();

        $tags = \App\Tag::all();

        \App\Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}
