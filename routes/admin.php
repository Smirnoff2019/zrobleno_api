<?php

use App\Filters\ImageFilter;
use App\Models\AccessToken\AccessToken;
use App\Models\Image\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\ComponentAttributeBag;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/csrf', function (Request $request) {
    return response()->json(csrf_token());
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/home', 'MainController@home')->name('home');

    Route::resource('/calculator/settings/coefficient/region', 'CalculatorSettings\CoefficientPerRegionController')->names('calculator-settings.coefficient-per-region');

    Route::resource('/calculator/settings/coefficient/ceiling-height', 'CalculatorSettings\CeilingHeightCoefficientController')->names('calculator-settings.ceiling-height-coefficient');

    Route::resource('/calculator/settings/coefficient/property-condition', 'CalculatorSettings\PropertyConditionCoefficientController')->names('calculator-settings.property-condition-coefficient');

    Route::resource('/calculator/settings/coefficient/walls-condition', 'CalculatorSettings\PropertyWallsConditionCoefficientController')->names('calculator-settings.property-walls-condition-coefficient');

    // Route::resource('/calculator/settings/coefficient', 'CalculatorSettings\CoefficientController')->names('calculator-settings.coefficient');

    Route::post('/notifications/{id}/read', 'Notification\NotificationController@read')->name('notifications.read');
    Route::get('/notifications', 'Notification\NotificationController@index')->name('notifications.index');

    Route::resource('/rooms', 'Room\RoomController');

    Route::resource('/projects', 'Project\ProjectController');

    Route::resource('/tenders/application', 'TenderApplication\TenderApplicationController')->names('tenders.applications');

    Route::post('/tenders/application/{application}/reject', 'TenderApplication\TenderApplicationController@reject')->name('tenders.applications.reject');

    Route::post('/tenders/application/{application}/confirm', 'TenderApplication\TenderApplicationController@confirm')->name('tenders.applications.confirm');
    
    Route::resource('/tenders/restart', 'Tender\TenderRestartController')->names('tenders.restart-applications');
    
    Route::post('/tenders/restart/{tender}/reject', 'Tender\TenderRestartController@reject')->name('tenders.restart-applications.reject');
    
    Route::post('/tenders/restart/{tender}/confirm', 'Tender\TenderRestartController@confirm')->name('tenders.restart-applications.confirm');
    
    Route::resource('/tenders', 'Tender\TenderController');

    Route::resource('/options/groups', 'OptionsGroup\OptionsGroupController')->names('options-groups');

    Route::resource('/options', 'Option\OptionController');

    Route::resource('/posts/categories', 'Post\PostCategoryController')->names('posts.categories');

    Route::resource('/posts', 'Post\PostController');

    Route::resource('/widgets', 'Widget\WidgetController');

    Route::resource('/menus', 'Menu\MenuController');

    Route::resource('/pages', 'Page\PageController');

    Route::resource('/taxonomies', 'Taxonomy\TaxonomyController');

    Route::post('/images/groups/store', 'Image\ImageController@createGroup')->name('images.groups.store');
    Route::resource('/images', 'Image\ImageController');

    Route::resource('/categories', 'Category\CategoryController');

    Route::resource('/users/contractors/portfolios', 'Portfolio\PortfolioContractorController')->names('users.contractors.portfolios');

    Route::resource('/portfolios/categories', 'Portfolio\PortfolioCategoryController')->names('portfolios.categories');

    Route::resource('/portfolios', 'Portfolio\PortfolioController');

    Route::resource('/suppliers', 'Supplier\SupplierController');

    Route::resource('/complaints', 'Complaint\ComplaintController');

    Route::resource('/users/personal-data-requests', 'UserPersonalDataChangeRequest\UserPersonalDataChangeRequestController')->names('users.personal-data-requests');
    
    Route::post('/users/personal-data-requests/{personalData}/reject', 'UserPersonalDataChangeRequest\UserPersonalDataChangeRequestController@reject')->name('users.personal-data-requests.reject');
    
    Route::post('/users/personal-data-requests/{personalData}/confirm', 'UserPersonalDataChangeRequest\UserPersonalDataChangeRequestController@confirm')->name('users.personal-data-requests.confirm');

    Route::resource('/users', 'Users\UserController');

    Route::resource('/avatars', 'Avatar\AvatarController');

    Route::resource('/accessTokens', 'AccessToken\AccessTokenController');

    Route::resource('/meta-fields/groups', 'MetaFieldsGroup\MetaFieldsGroupController')->names('meta-fields.groups');

    Route::get('/calculator', '\App\Http\Controllers\API\Calculator\CalculatorApiController@index');

    Route::get('/tests/queues', 'Tests\TestsController@index')->name('tests.queues.index');
    Route::post('/tests/queues', 'Tests\TestsController@queues')->name('tests.queues.send');

});

Route::get('/login', '\App\Http\Controllers\Admin\Auth\LoginController@login')->name('login');
Route::post('/authenticate', '\App\Http\Controllers\Admin\Auth\LoginController@authenticate')->name('authenticate');
Route::get('/logout', '\App\Http\Controllers\Admin\Auth\LogoutController')->name('logout');

Route::get('/contractors/sing-up/{token}', '\App\Http\Controllers\Admin\Auth\ContractorRegisterController@show')->name('contractors.sing-up.show');
Route::post('/contractors/sing-up/{token}', '\App\Http\Controllers\Admin\Auth\ContractorRegisterController@singUp')->name('contractors.sing-up.store');

Route::prefix('api/')->namespace('api')->name('api.')->group(function () {

    Route::apiResource('/images', '\App\Http\Controllers\API\Image\ImageApiController');

    Route::get('gallery/images/modal', function (Request $request, Image $image, ImageFilter $filter) {
        $images = $image->with('file')->filter($filter)->paginate(50);
        $type   = $request->get('mode') === 'single' ? 'radio' : 'checkbox';

        return response()->success(
            [
                'body'   => view(
                    'admin.runtime.modal-gallery-images',
                    [
                        'type'   => $type,
                        'images' => $images,
                    ]
                )->render(),
                'images' => $images,
            ],
            'Modal gallery images list successfully loaded!'
        );
    })->name('images-gallery.modal-content');

    Route::get('gallery/images', function (Request $request, Image $image) {
        $images = $image->with('file')->latest()->paginate(50);

        return response()->success(
            [
                'body'   => view('admin.runtime.gallery-images', ['records' => $images])->render(),
                'images' => $images,
            ],
            'Gallery images cards successfully loaded!'
        );
    })->name('images-gallery.index-content');

    Route::get('meta-field/generate', function (Request $request) {
        return response()->view('admin.runtime.meta-field', $request->all());
    })->name('meta-field.generate');

    Route::get('meta-field/images-gallery/item/generate', function (Request $request) {
        return response()->view('admin.runtime.meta-field-images-gallery-item', $request->all());
    })->name('meta-field.images-gallery.item');

    Route::get('append/field', function (Request $request) {
        return response()->view('admin.runtime.append-field', $request->all());
    })->name('append-field');

    Route::get('make/contractor/portfolio', function (Request $request) {
        return response()->view('admin.runtime.make-new-contractor-portfolio', $request->all());
    })->name('make-new-contractor-portfolio');

    Route::get('make/image/{image}/edit-form/modal', function (Request $request, Image $image) {
        return response()->view('admin.runtime.modal-image-edit-form', [
            $request->all(),
            'image' => $image
        ]);
    })->name('images.make-modal-edit-form');

});

Route::get('/tenders/{tender}/document', '\App\Http\Controllers\PdfController@makeProjectTR')->name('tenders.document');
Route::get('/tenders/{tender}/document/show', '\App\Http\Controllers\PdfController@showProjectTR')->name('tenders.document.show');
Route::get('/tenders/{tender}/pdf', '\App\Http\Controllers\PdfController@makePdfProjectTR')->name('tenders.pdf');