<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/newsletters', NewsletterController::class);

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/products', [ProductController::class, 'index']);

Route::get('/wishlist', function () {
    return view('pages.wishlist');
});
Route::get('/compare-products', function () {
    return view('pages.compare-products');
});

Route::get('p/{product:slug}', [ProductController::class, 'show']);

Route::post(
    '/p/{product:slug}/comment',
    [ProductCommentController::class, 'store']
);

require __DIR__.'/auth.php';
