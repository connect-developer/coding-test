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

Route::get('/jobs', [JobController::class, 'view'])->name('job.view');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('job.show');

Route::get('/admin/jobs', [JobController::class, 'viewByAdmin'])->name('job.view.admin');
Route::get('/admin/jobs/{id}', [JobController::class, 'showAdmin'])->name('job.show.admin');
Route::post('/admin/jobs', [JobController::class, 'create'])->name('job.create');
Route::put('/admin/jobs/{id}', [JobController::class, 'update'])->name('job.update');
Route::delete('/admin/jobs/{id}', [JobController::class, 'delete'])->name('job.delete');


Route::middleware(['guest'])->prefix('/company')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('/company')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('me', [AdminController::class, 'me']);
});

Route::group(['prefix' => 'company'], function () {
    Route::get('jobs', [JobController::class, 'viewByAdmin'])->name('job.view.admin');
    Route::get('jobs/{id}', [JobController::class, 'showAdmin'])->name('job.show.admin');
    Route::post('jobs', [JobController::class, 'create'])->name('job.create');
    Route::put('jobs/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('jobs/{id}', [JobController::class, 'delete'])->name('job.delete');
});
