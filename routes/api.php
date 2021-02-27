<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/gds/login', function (Request $request) {
    return 'awd';
});

Route::middleware(['clientToken'])->group(function () {
    Route::post('/gds/login', [
        App\Http\Controllers\Api\MainApiController::class,
        'loginUser'
    ]);
    Route::post('/gds/register', [
        App\Http\Controllers\Api\MainApiController::class,
        'registerUser'
    ]);
});

