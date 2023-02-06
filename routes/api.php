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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function (){
   Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
   Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register'])
       ->middleware('throttle: 60, 1')->name('register');
   Route::post('/restore', [\App\Http\Controllers\Api\AuthController::class, 'restore'])->name('restore');
   Route::post('/restore/confirm', [\App\Http\Controllers\Api\AuthController::class, 'restoreConfirm'])->name('restore-confirm');

});

Route::group(['middleware' => 'auth:sanctum'], function (){

});
