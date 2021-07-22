<?php

use App\Models\Option\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('events', function (){
//     $user = User::find(5);
//     $tender = \App\Models\Tender\Tender::find(5);
//     event(new App\Events\Tender\ContractorBuyTenderEvent($user, $tender));
// });


// Route::get('notifications', function (){

//    $payment = \App\Models\Payment\Payment::create(array_merge(['type' => 'debit' , 'value' => 1000],[
//        'order_reference' => 'adasdasdasdasdasd',
//        'balance' => 10000,
//        'status_id' => 1,
//        'account_id' => 5,
//        'tender_id' => 1
//    ]));


//    $payment->update(['status_id' => 1]);

//    TenderParticipant::create(
//        [
//            TenderParticipantSchema::COLUMN_USER_ID => 5,
//            TenderParticipantSchema::COLUMN_TENDER_ID => 3,
//        ]
//    );

//    $user = User::find(5);
//    $pay = \App\Models\Payment\Payment::where('account_id', 5)->with('status')->first();
//
//    User::find(5)->notify(new \App\Notifications\NotificationTypes\Payments\InformationPaymentNotification(
//        [
//            'type' => 'tender',
//            'id'   => '2'
//        ],
//        [
//            'content' => 'Новый'
//        ],
//        $pay,
//        $user
//    ));

// });

Route::domain('customer.zrobleno.com.ua')
    ->name('servises.customer.')
    ->group(function () {
        $domain = 'https://customer.zrobleno.com.ua';

        Route::redirect('/', $domain)->name('home');
        Route::redirect('/tender', "$domain/tender")->name('tenders.index');
        Route::redirect('/tender/{tender}', "$domain/tender/{tender}")->name('tenders.show');
        Route::redirect('/application', "$domain/application")->name('applications.index');
        Route::redirect('/partner', "$domain/partner")->name('partners.index');
        Route::redirect('/cards', "$domain/cards")->name('cards.index');

    });


Route::domain('contractor.zrobleno.com.ua')
    ->name('servises.contractor.')
    ->group(function () {
        $domain = 'https://contractor.zrobleno.com.ua';

        Route::redirect('/', $domain)->name('home');
        Route::redirect('/tenders', "$domain/tenders")->name('tenders.index');
        Route::redirect('/tenders/my', "$domain/tenders/my")->name('tenders.my');
        Route::redirect('/tender/{tender}', "$domain/tender/{tender}")->name('tenders.show');
        Route::redirect('/partner', "$domain/partner")->name('partners.index');
        Route::redirect('/cards', "$domain/cards")->name('cards.index');
        
    });

Route::get('/csrf', function (Request $request) {
    return response()->json(csrf_token());
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return view('site-home-page');
})->name('site.home');

Route::get('/test', function () {
    $token = \Illuminate\Support\Str::random(5);

    setcookie('test_token', $token);

    return response($token);
    
    dd([
        // Option::whereNull('description')->get()->each(function($option) {
        //     return $option->update([
        //         'description' => Arr::random([
        //             "Ac turpis egestas integer eget aliquet. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque.",
        //             "Sed enim ut sem viverra aliquet eget sit amet. Sagittis eu volutpat odio facilisis mauris sit.",
        //             "Lobortis scelerisque fermentum dui faucibus in ornare quam viverra orci, laoreet suspendisse.",
        //             "Purus faucibus ornare suspendisse sed nisi lacus sed. Integer quis auctor elit sed vulputate mi.",
        //             "Vulputate sapien nec sagittis aliquam malesuada bibendum. Vitae aliquet nec ullamcorper sit amet risus nullam.",
        //             "Diam donec adipiscing tristique risus nec. Sed odio morbi quis commodo odio aenean.",
        //             "Vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt. Vitae semper quis lectus nulla at volutpat diam.",
        //             "Elementum tempus egestas sed sed risus pretium quam vulputate. Libero justo laoreet sit amet.",
        //             "Eget nulla facilisi etiam dignissim diam quis enim. Lacus vestibulum sed arcu non.",
        //             "Quisque id diam vel quam elementum pulvinar. Massa massa ultricies mi quis hendrerit dolor.",
        //             "Id velit ut tortor pretium viverra. Laoreet non curabitur gravida arcu ac. At consectetur lorem donec massa.",
        //         ])
        //     ]);
        // })->push()
    ]);
    
})->name('test');

Route::get('/tenders/{tender}/document', '\App\Http\Controllers\PdfController@makeProjectTR')->name('tenders.document');
Route::get('/tenders/{tender}/document/show', '\App\Http\Controllers\PdfController@showProjectTR')->name('tenders.document.show');
Route::get('/tenders/{tender}/pdf', '\App\Http\Controllers\PdfController@makePdfProjectTR')->name('tenders.pdf');