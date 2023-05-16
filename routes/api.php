<?php

use App\Http\Controllers\Admin\JobController as AdminJobController;
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
Route::apiResource('/admin/jobs',AdminJobController::class);
Route::get('/jobs', [JobController::class, 'index'])->name('job.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('job.show');


