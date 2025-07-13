<?php


use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::name('auth')
    ->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

    });

Route::middleware('auth:sanctum')
    ->name('user')
    ->get('/user', function () {
        return auth()->user();
    });


Route::middleware(['auth:sanctum', 'admin'])
    ->name('product.')
    ->group(function () {
        Route::apiResource('product', ProductController::class)
            ->only(['store', 'update', 'destroy']);
    });


Route::middleware(['auth:sanctum'])
    ->name('product.')
    ->group(function () {
        Route::apiResource('product', ProductController::class)
            ->only(['index', 'show']);
    });

Route::middleware('auth:sanctum')
    ->name('order.')
    ->group(function () {
        route::apiResource('order', OrderController::class);
    });
