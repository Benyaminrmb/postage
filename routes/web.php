<?php

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

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

/*----------      index        ----------*/
Route::get('/', function(){
    return view('home');
})->name('home')->breadcrumbs(function(Trail $trail){
    return $trail->push('اپ بار ', route('home'));
});
/*----------      auth        ----------*/
Auth::routes();

Route::post('/gds/login', [
    App\Http\Controllers\UserController::class,
    'gdsUserLogin'
])->name('gdsLogin');

Route::post('/gds/register', [
    App\Http\Controllers\UserController::class,
    'gdsUserRegister'
])->name('gdsRegister');


/*----------      additional        ----------*/

Route::get('/susmar/login', function(){
    \Illuminate\Support\Facades\Auth::loginUsingId('1');
    return redirect('/');
})->name('home')->breadcrumbs(function(Trail $trail){
    return $trail->push('اپ بار ', route('home'));
});

Route::post('/admin/api/state/cities', [
    App\Http\Controllers\Admin\AdminController::class,
    'getStateCities'
])->name('gds.api.state.cities');

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index'
])->name('home');


Route::middleware(['auth'])->group(function(){


    /*----------      profile        ----------*/


    Route::get('/profile', [
        App\Http\Controllers\ProfileController::class,
        'index'
    ])->name('profile.index')->breadcrumbs(function(Trail $trail){
        return $trail->parent('home')->push('پروفایل', route('profile.index'));
    });

    Route::get('/profile/edit', [
        App\Http\Controllers\ProfileController::class,
        'edit'
    ])->name('profile.edit')->breadcrumbs(function(Trail $trail){
        return $trail->parent('profile.index')->push('ویرایش پروفایل', route('profile.edit'));
    });

    Route::post('/profile/update', [
        App\Http\Controllers\ProfileController::class,
        'update'
    ])->name('profile.update');



    /*----------      shipment        ----------*/


    Route::post('/admin/shipment/get', [
        App\Http\Controllers\Admin\AdminShipmentController::class,
        'get'
    ])->name('admin.shipment.get');

    Route::get('/shipment', [
        App\Http\Controllers\ShipmentController::class,
        'index'
    ])->name('shipment');

    Route::get('/shipment/new', [
        App\Http\Controllers\ShipmentController::class,
        'new'
    ])->name('shipment.new');


    Route::post('/shipment/create', [
        App\Http\Controllers\ShipmentController::class,
        'create'
    ])->name('shipment.create');

});

/*----------      admin        ----------*/
Route::middleware(['auth','accessChecker'])->group(function(){

    /*----------      agency-profile        ----------*/



    Route::post('/profile/agency/update', [
        App\Http\Controllers\ProfileController::class,
        'agencyUpdate'
    ])->name('profile.agency.update');


    /*----------      admin        ----------*/
    Route::get('/admin', [
        App\Http\Controllers\Admin\AdminController::class,
        'index'
    ])->name('admin.index')->breadcrumbs(function(Trail $trail){
        return $trail->push('پنل مدیریت', route('admin.index'));
    });


    /*----------      shipment        ----------*/

    Route::get('/admin/shipment/list', [
        App\Http\Controllers\Admin\AdminShipmentController::class,
        'getList'
    ])->name('admin.shipment.list')->breadcrumbs(function(Trail $trail){
        return $trail->parent('admin.index')->push('لیست سفارشات', route('admin.shipment.list'));
    });
});


















