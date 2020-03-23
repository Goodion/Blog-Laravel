<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\News::class, 10)->create();

        $tags = \App\Tag::all();

        \App\News::all()->each(function ($news) use ($tags) {
            $news->tags()->attach(
                $tags->random(rand(1,7))->pluck('id')->toArray()
            );
        });
    }

}
