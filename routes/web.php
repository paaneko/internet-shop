<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('p/{product:slug}', [ProductController::class, 'show']);

Route::get('/register', [RegisterController::class, 'create'])->middleware(
    'guest'
);
Route::post('/register', [RegisterController::class, 'store'])->middleware(
    'guest'
);

Route::get('/login', [SessionController::class, 'create'])->middleware(
    'guest'
);
Route::post('/login', [SessionController::class, 'store'])->middleware(
    'guest'
);

Route::post('/logout', [SessionController::class, 'destroy'])->middleware(
    'auth'
);
