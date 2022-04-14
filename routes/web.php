<?php

use App\Http\Controllers\AdminController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CommunityController;
use App\Http\Middleware\EnsureUserIsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




//Admin routes
Route::middleware(['auth', EnsureUserIsAdmin::class, 'verified'])->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('admin.panel');
    Route::delete('/admin/users/{id}', 'delete')->name('admin.delete.user');
});


//Request routes
Route::middleware(['auth', 'verified'])->controller(RequestController::class)->group(function () {

    Route::get('/requests', 'index')->name('request.index');
    Route::get('/requests/{id}',  'view')->name('request.view');
    Route::get('/create', 'create')->name('request.create');
    Route::post('/store',  'store')->name('request.store');
    Route::delete('/requests/{id}', 'delete')->name('request.delete');
    Route::get('/requests/{id}/edit', 'edit')->name('request.edit');
    Route::put('/requests/{id}', 'update')->name('request.update');
    Route::put('/requests/{id}/close', 'closeRequest')->name('request.close');
});

Route::get('/feed', [RequestController::class, 'feed'])->name('request.feed');




// Review routes
Route::middleware(['auth', 'verified'])->controller(ReviewController::class)->group(function () {

    Route::post('/review/requests/{id}',  'store')->name('review.store');
    Route::delete('/reviews/{id}/requests/{requestId}', 'delete')->name('review.delete');
    Route::put('/reviews/{id}/requests/{requestId}', 'update')->name('review.update');
});




// like routes
Route::middleware(['auth', 'verified'])->controller(LikeController::class)->group(function () {

    Route::post('/like/reviews/{id}', 'store')->name('like.store');
    Route::delete('/like/reviews/{id}', 'delete')->name('like.delete');
});




//community routes 
Route::middleware(['auth', 'verified'])->controller(CommunityController::class)->group(function () {

    Route::post('community',  'store')->name('community.store');
    Route::delete('communities/{id}',  'delete')->name('community.delete');
    Route::get('/community/create', 'create')->name('community.create');
});




Route::controller(CommunityController::class)->group(function () {

    Route::get('/communities/{id}/requests', 'feed')->name('community.feed');
    Route::get('/communities', 'index')->name('community.index');
});




require __DIR__ . '/auth.php';
