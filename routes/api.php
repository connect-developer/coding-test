<?php

use App\Http\Controllers\Api\V1\JobController;
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

Route::group(['prefix' => '/{path}', 'middleware' => 'admin.company.path'], function () {
    Route::post('/register', [UserController::class, 'register'])->name('action.register');
    Route::post('/login', [LoginController::class, 'login'])->name('action.login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [LoginController::class, "logout"])->name('action.logout');
        Route::post('/me', [UserController::class, "me"])->name('action.me');

        Route::group(['prefix' => '/job'], function () {
            Route::group(['prefix' => '/list/all'], function () {
                Route::get('/', [JobController::class, "jobListAll"])->name('action.job.all');
                Route::post('/search', [JobController::class, "jobListAllSearch"])->name('action.job.all.search');
                Route::post('/search/page', [JobController::class, "jobListAllSearchPage"])->name('action.job.all.search.page');
            });

            Route::get('/{id}', [JobController::class, "jobShow"])->name('action.job.show');
        });
    });
});

Route::group(['prefix' => '/job'], function () {
    Route::group(['prefix' => '/list/all'], function () {
        Route::get('/', [JobController::class, "jobListAll"])->name('action.job.all');
        Route::post('/search', [JobController::class, "jobListAllSearch"])->name('action.job.all.search');
        Route::post('/search/page', [JobController::class, "jobListAllSearchPage"])->name('action.job.all.search.page');
    });
});



