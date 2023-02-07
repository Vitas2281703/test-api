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

Route::group(['prefix' => 'auth'], function (){
   Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
   Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register'])
       ->middleware('throttle: 60, 1')->name('register');
   Route::post('/restore', [\App\Http\Controllers\Api\AuthController::class, 'restore'])->name('restore');
   Route::post('/restore/confirm', [\App\Http\Controllers\Api\AuthController::class, 'restoreConfirm'])->name('restore-confirm');

});

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/departments', [\App\Http\Controllers\Api\DepartmentController::class, 'showDepartments'])->name('departments');

    Route::group(['prefix' => 'workers'], function (){
       Route::get('/', [\App\Http\Controllers\Api\WorkerController::class, 'getWorkers'])->name('workers');
       Route::get('/{user}', [\App\Http\Controllers\Api\WorkerController::class, 'getWorker'])->name('worker');
    });
});
