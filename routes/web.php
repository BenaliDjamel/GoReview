<?php

use App\Http\Controllers\RequestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/hello', function () {
    return Inertia::render('HelloInertia', [
        'name' => 'djamel benali - Software Enginner'
    ]);
});

Route::get('/requests', [RequestController::class, 'index'])->name('request.index')->middleware(['auth', 'verified']);
Route::get('/create', [RequestController::class, 'create'])->name('request.create')->middleware(['auth', 'verified']);
Route::post('/store', [RequestController::class, 'store'])->name('request.store')->middleware(['auth', 'verified']);
Route::delete('/request/{id}', [RequestController::class, 'delete'])->name('request.delete')->middleware(['auth', 'verified']);




require __DIR__ . '/auth.php';
