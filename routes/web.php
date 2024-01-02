<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/products', [ProductController::class, 'index']);

Route::get('p/{product:slug}', [ProductController::class, 'show']);

require __DIR__.'/auth.php';
