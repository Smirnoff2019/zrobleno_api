<?php

use Illuminate\Database\Seeder;
use App\Models\MetaField\UrlField;
use App\Models\MetaField\TextField;
use App\Models\MetaField\EmailField;
use App\Models\MetaField\GroupField;
use App\Models\MetaField\ImageField;
use App\Models\MetaField\NumberField;
use App\Models\MetaField\SelectField;
use App\Models\MetaField\CheckboxField;
use App\Models\MetaField\CKEditorField;
use App\Models\MetaField\TextareaField;
use App\Models\MetaField\MetaFieldsGroup;
use App\Models\MetaField\RadioButtonField;
use App\Models\MetaField\ImagesGalleryField;
use App\Models\MetaField\MetaField;

class MetaFieldTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MetaField::query()->delete();

        factory(MetaFieldsGroup::class)->create();
        factory(TextField::class)->create();
        factory(TextareaField::class)->create();
        factory(NumberField::class)->create();
        factory(PasswordField::class)->create();
        factory(EmailField::class)->create();
        factory(UrlField::class)->create();
        factory(ImageField::class)->create();
        factory(ImagesGalleryField::class)->create();
        factory(CKEditorField::class)->create();
        factory(SelectField::class)->create();
        factory(CheckboxField::class)->create();
        factory(RadioButtonField::class)->create();
        factory(GroupField::class)->create();

    }

}
