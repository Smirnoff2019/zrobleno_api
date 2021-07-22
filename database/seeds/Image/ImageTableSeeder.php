<?php

use App\Models\File\File;
use App\Models\Image\Image;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Image::class, 3)->create([
            Image::COLUMN_FILE_ID => factory(File::class)->create([
                File::COLUMN_NAME          => 'defaullt.jpg',
                File::COLUMN_PATH          => "public/images/defaullt.jpg",
                File::COLUMN_URL           => env("APP-URL")."/images/defaullt.jpg",
                File::COLUMN_URI           => "images/defaullt.jpg",
                File::COLUMN_FORMAT        => 'jpg',
            ])
        ]);
    }

}
