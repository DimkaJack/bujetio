<?php

use App\Http\Controllers\Inertia\CategoryController;
use App\Http\Controllers\Inertia\DashboardController;
use App\Http\Controllers\Inertia\ProductController;
use App\Http\Controllers\Inertia\TagController;
use App\Http\Controllers\Inertia\TransactionController;
use App\Http\Controllers\ProfileController;
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
        'canRegister' => config('auth.registration.enabled'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->middleware(['auth', 'verified']);

Route::resource('products', ProductController::class)
    ->middleware(['auth', 'verified']);

Route::resource('tags', TagController::class)
    ->middleware(['auth', 'verified']);

Route::resource('transactions', TransactionController::class)
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
