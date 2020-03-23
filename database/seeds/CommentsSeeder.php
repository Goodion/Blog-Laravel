<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Comment::class, 50)->create(
            ['author_id' => factory(App\User::class)->create()->id]
        );
    }
}
