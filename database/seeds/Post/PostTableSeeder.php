<?php

use App\Models\Post\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Post::class, 5)->create();

    }

}
