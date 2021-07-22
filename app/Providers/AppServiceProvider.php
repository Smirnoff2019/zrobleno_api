<?php

namespace App\Providers;

use App\Models\Category\Category;
use App\Models\Meta\Meta;
use App\Models\Post\Post;
use App\Models\PostType\PostType;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        Relation::morphMap([
            'posts'      => Post::class,
            'postTypes'  => PostType::class,
            'categories' => Category::class,
            'meta'       => Meta::class,
            'taxonomy'   => Taxonomy::class,
            'taxonomy'   => PortfolioCategoryTaxonomy::class,
        ]);

        Blade::directive('metaFieldTypeName', function ($slug) {
            return  "<?php 
                        \$names = [
                            'text'           => 'Текст',
                            'textarea'       => 'Область тексту',
                            'number'         => 'Число',
                            'email'          => 'E-mail адреса',
                            'url'            => 'Url',
                            'password'       => 'Пароль',
                            'image'          => 'Зображення',
                            'images_gallery' => 'Галерея зображень',
                            'wysiwyg'        => 'Візуальний редактор',
                            'select'         => 'Випадаючий список',
                            'checkbox'       => 'Галочка',
                            'radio'          => 'Radio Button',
                            'true_false'     => 'Так / Ні',
                            'group'          => 'Група',
                        ];
                        echo (\$names[$slug] ?? $slug); 
                    ?>";
        });

        Blade::directive('selected', function ($check) {
            return  "<?php 
                        if($check) echo 'selected=\"selected\"'; 
                    ?>";
        });

        Blade::directive('checked', function ($check) {
            return  "<?php 
                        if($check) echo 'checked=\"checked\"'; 
                    ?>";
        });

        Blade::directive('sup', function ($text) {
            return  "<sup>$text</sup>";
        });

        Blade::directive('nformat', function ($number) {
            return  "<?php 
                echo number_format($number ?? 0, 0, '.', ' ')
            ?>";
        });
        
        Blade::directive('clock', function (...$args) {
            clock($args);
            
            return  "";
        });

    }

}
