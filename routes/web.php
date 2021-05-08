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
Route::middleware(['agencyShipmentData'])->group(function(){


    Route::get('/test', function(){

    })->name('home')->breadcrumbs(function(Trail $trail){
        return $trail->push('تست', route('home'));
    });


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

    Route::get('/home', [
        App\Http\Controllers\HomeController::class,
        'index'
    ])->name('home');


    Route::middleware(['auth'])->group(function(){

        Route::post('/admin/api/state/cities', [
            App\Http\Controllers\Admin\AdminController::class,
            'getStateCities'
        ])->name('gds.api.state.cities');


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

        Route::get('/profile/panel/', [
            App\Http\Controllers\ProfileController::class,
            'panelIndex'
        ])->name('panel.index')->breadcrumbs(function(Trail $trail){
            return $trail->push('پیشخوان', route('panel.index'));
        });

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
    Route::middleware([
        'auth',
        'accessChecker'
    ])->group(function(){

        /*----------      agency-profile        ----------*/



        Route::get('/profile/agency/edit/state', [
            App\Http\Controllers\ProfileController::class,
            'editAgencyState'
        ])->name('profile.agency.edit.state')->breadcrumbs(function(Trail $trail){
            return $trail->parent('profile.edit')->push('ویرایش شهر نمایندگی', route('profile.agency.edit.state'));
        });


        /*----------      admin        ----------*/
        Route::get('/admin', [
            App\Http\Controllers\Admin\AdminController::class,
            'index'
        ])->name('admin.index')->breadcrumbs(function(Trail $trail){
            return $trail->push('پنل مدیریت', route('admin.index'));
        });


        /*----------      shipment        ----------*/

        Route::get('/admin/shipments/list/{statusId?}', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'getList'
        ])->name('admin.shipments.list')->breadcrumbs(function(Trail $trail){
            return $trail->parent('admin.index')->push('لیست سفارشات', route('admin.shipments.list'));
        });

        Route::post('/admin/shipment/create/order', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'createOrder'
        ])->name('admin.shipment.createOrder');

        Route::post('/admin/shipment/remove/order', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'removeOrder'
        ])->name('admin.shipment.removeOrder');

        Route::get('/admin/shipment/{shipmentId}', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'detail'
        ])->name('admin.shipment.detail')->breadcrumbs(function(Trail $trail){
            return $trail->parent('admin.shipments.list')->push('جزئیات سفارش', route('admin.shipment.detail', ''));
        });

        Route::post('/admin/shipment/edit/stepStatus', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'editStepStatus'
        ])->name('admin.shipment.editStepStatus');

        Route::get('/admin/shipments/options/new', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'newShipmentOptions'
        ])->name('admin.shipments.options.new')->breadcrumbs(function(Trail $trail){
            return $trail->parent('admin.shipments.options')->push('افزودن گذینه', route('admin.shipments.options.new'));
        });

        Route::get('/admin/shipments/options/', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'listShipmentOptions'
        ])->name('admin.shipments.options')->breadcrumbs(function(Trail $trail){
            return $trail->parent('admin.index')->push('تنظیمات مرسولات', route('admin.shipments.options'));
        });

        Route::post('/admin/shipments/options/', [
            App\Http\Controllers\Admin\AdminShipmentController::class,
            'storeShipmentOptions'
        ])->name('admin.shipments.new.options');

    });
});
Route::middleware([
    'auth',
    'accessChecker'
])->group(function(){




    Route::post('/profile/agency/update', [
        App\Http\Controllers\ProfileController::class,
        'agencyUpdate'
    ])->name('profile.agency.update');
});
