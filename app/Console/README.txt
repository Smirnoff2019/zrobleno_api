<?

/** -----------------------------------------------------------------------------------
 * Create a repository for model
 * 
 * @param $name[:?Repository] :Repository file&class name
 * @option --t=[:true|false] :Indicates whether to add the type to the name
 */ 

php artisan make:repository $name[:?Repository] --t=[:true|false]

#Examples: 

    php artisan make:repository Post 
        #> Create "PostRepository" App\Repositories\Eloquent\Post\PostRepository
        
    php artisan make:repository PostRepository
        #> Create "PostRepository" App\Repositories\Eloquent\Post\PostRepository
        
    php artisan make:repository Post --t=false
        #> Create "Post" App\Repositories\Eloquent\Post\Post

/** -----------------------------------------------------------------------------------
 * Create a new essence (migrations, model, schema)
 * 
 * @param $name[:?Repository] :Repository file&class name
 * @option --t=[:true|false] :Indicates whether to add the type to the name
 */ 

php artisan make:essence {$model_name} {$table_name}  --t=[:true|false]

#Examples: 

    php artisan make:essence User users

    php artisan make:essence Status statuses


/** -----------------------------------------------------------------------------------
 * Create a repository interface for repository
 * 
 * @param $name[:?Repository] :Repository interface file&class name
 * @option --t=[:true|false] :Indicates whether to add the type to the name
 */ 

php artisan make:repository-interface $name[:?Repository] --t=[:true|false]

#Examples: 

    php artisan make:repository-interface Post 
        #> Create "PostRepositoryInterface" App\Repositories\Eloquent\Post\Interfaces\PostRepositoryInterface
        
    php artisan make:repository-interface PostRepository
        #> Create "PostRepositoryInterface" App\Repositories\Eloquent\Post\Interfaces\PostRepositoryInterface
        
    php artisan make:repository-interface Post --t=false
        #> Create "Post" App\Repositories\Eloquent\Post\Interfaces\Post



/** -----------------------------------------------------------------------------------
 * Create a new api resource rotes file
 * 
 * @param $name :File name
 * @param $controller :Controller name
 * @option --t=[:true|false] :Indicates whether to add the type to the name
 */ 

php artisan make:apiRoutes $name $controller --t=[:true|false]
                        
#Examples: 

    php artisan make:apiRoutes Post/Post PostApiController
        #> Create "PostRoutes" routes/API/Post/PostRoutes.php
    
    php artisan make:apiRoutes Project/Project ProjectController
        #> Create "ProjectRoutes" routes/API/Project/ProjectRoutes.php



/** -----------------------------------------------------------------------------------
 * Create model resource and resource collection
 * 
 * @param $namespace :File namespace
 */ 

php artisan make:resource $namespace

#Examples:
    
    php artisan make:resource Room/RoomResource
        #> Create "RoomResourceCollection" App\Http\Resources\Room\RoomResource
    
    php artisan make:resource Room/RoomResourceCollection
        #> Create "RoomResourceCollection" App\Http\Resources\Room\RoomResourceCollection



/** -----------------------------------------------------------------------------------
 * Autoload files
 */ 

> composer dumpautoload

/** -----------------------------------------------------------------------------------
 * DB refresh and run seeders
 * and after at install api passport
 */ 

> php artisan migrate:fresh --seed && php artisan passport:install
> composer dump-autoload && php artisan migrate:fresh --seed && php artisan passport:install

lt -p=80 --local-host=api.zrobleno.loc --allow-invalid-cert -o