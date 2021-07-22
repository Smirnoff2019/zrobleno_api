<?php

use App\Models\PostType\PostType;
use Illuminate\Database\Seeder;

class PostTypeTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(PostType::class)->states('post')->create();
        factory(PostType::class)->states('page')->create();
        factory(PostType::class)->states('widget')->create();
        factory(PostType::class)->states('form')->create();
        factory(PostType::class)->states('menu')->create();
        factory(PostType::class)->states('portfolio')->create();

    }

}
