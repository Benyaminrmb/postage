<?php

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

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index'
])->name('home');

Route::post('/gds/login', [
    App\Http\Controllers\UserController::class,
    'gdsUserLogin'
])->name('gdsLogin');

Route::post('/gds/register', [
    App\Http\Controllers\UserController::class,
    'gdsUserRegister'
])->name('gdsRegister');

Route::get('/profile', [
    App\Http\Controllers\ProfileController::class,
    'index'
])->name('profile.index');
Route::get('/profile/edit', [
    App\Http\Controllers\ProfileController::class,
    'edit'
])->name('profile.edit');
Route::post('/profile/update', [
    App\Http\Controllers\ProfileController::class,
    'update'
])->name('profile.update');


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






