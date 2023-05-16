<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Log;
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

Route::group(['prefix' => 'jobs'], function () {
    Route::get('', [JobController::class, 'index']);
    Route::get('{job}', [JobController::class, 'show']);
});


Route::group(['prefix' => '/admin'], function () {

    Route::post('login', [LoginController::class, 'login'])->name('login');

    // Protected routes requiring authentication
    Route::middleware('auth:sanctum')->name('admin.')->group(function () {
        Route::post('logout', [LoginController::class, 'logout']);
        Route::get('me', [AdminController::class, 'me']);

        // Jobs
        Route::apiResource('jobs', JobController::class);
    });


    //Jobs
    //Route::apiResource('jobs', JobController::class);
    // Route::get('jobs', [JobController::class, 'viewByAdmin'])->name('job.view.admin');
    // Route::get('jobs/{job}', [JobController::class, 'showByAdmin'])->name('job.show.admin');

    // Route::post('jobs', [JobController::class, 'create'])->name('job.create');
    // Route::put('jobs/{job}', [JobController::class, 'update'])->name('job.update');
    // Route::delete('jobs/{job}', [JobController::class, 'delete'])->name('job.delete');
});
