<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['guest'])->prefix('/admin')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('/admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('me', [AdminController::class, 'me']);
});

Route::prefix('/jobs')->group(function () {
    Route::get('', [JobController::class, 'view'])->name('job.view');
    Route::get('/{id}', [JobController::class, 'show'])->name('job.show');
});

Route::prefix('/admin')->group(function () {
    Route::prefix('/jobs')->group(function () {
        Route::get('', [JobController::class, 'viewByAdmin'])->name('job.view.admin');
        Route::get('/{id}', [JobController::class, 'showAdmin'])->name('job.show.admin');
        Route::post('', [JobController::class, 'create'])->name('job.create');
        Route::put('/{id}', [JobController::class, 'update'])->name('job.update');
        Route::delete('/{id}', [JobController::class, 'delete'])->name('job.delete');
    });
});