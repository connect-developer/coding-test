<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Company\AdminController as CompanyAdminController;
use App\Http\Controllers\Company\AuthController;
use App\Http\Controllers\Company\CompanyController;
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
Route::get('/admin/jobs/{id}', [JobController::class, 'showByAdmin'])->name('job.show.admin');
Route::post('/admin/jobs', [JobController::class, 'create'])->name('job.create');
Route::put('/admin/jobs/{id}', [JobController::class, 'update'])->name('job.update');
Route::delete('/admin/jobs/{id}', [JobController::class, 'delete'])->name('job.delete');

Route::prefix('company')->as('company.')->group(function() {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/me', [CompanyAdminController::class, 'me'])->name('me');
        Route::resource('/jobs', CompanyController::class);
    });
});