<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('categories')
        ->controller(CategoryController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::patch('/{uuid}', 'update');
            Route::delete('/{uuid}', 'destroy');
        });

    Route::prefix('transactions')
        ->controller(TransactionController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::patch('/{uuid}', 'update');
            Route::delete('/{uuid}', 'destroy');
        });
});

