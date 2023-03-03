<?php

use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
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

Route::group(['prefix' => '{path}', 'middleware' => 'admin.company.path'], function () {
    Route::post('/register', [UserController::class, 'register'])->name('action.register');
    Route::post('/login', [LoginController::class, 'login'])->name('action.login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [LoginController::class, "logout"])->name('action.logout');
    });
});



