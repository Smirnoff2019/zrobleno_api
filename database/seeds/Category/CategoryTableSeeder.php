<?php

use App\Models\Category\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create()->each(function($category) {
            factory(Category::class, rand(0, 5))->create([
                Category::COLUMN_PARENT_ID => $category->id
            ]);
        });
        factory(Category::class, 10)->create();

    }

}
