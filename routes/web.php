<?php

declare(strict_types=1);

use App\Http\Controllers\Checkout\CheckoutCancelController;
use App\Http\Controllers\Checkout\CheckoutSuccessController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\VariationController;
use App\Livewire\Pages\CategoryFilter;
use App\Livewire\Pages\Compare;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Wishlist;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', Home::class)
    ->name('home');

Route::get('/checkout-success', CheckoutSuccessController::class)->name(
    'checkout-success'
)->middleware('auth');

Route::get('/checkout-cancel', CheckoutCancelController::class)->name(
    'checkout-cancel'
)->middleware('auth');

Route::post('/newsletters', NewsletterController::class);

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/wishlist', Wishlist::class)
    ->name('wishlist');

Route::get('/compare', Compare::class)
    ->name('compare');

if (config('app.env') == 'local') {
    Route::get('/test', function () {
        return view('pages.test');
    })->name('test');
}

Route::get('/v/{variation}', [VariationController::class, 'show'])
    ->name('variation');

Route::get('{category}/{filterUrl?}', CategoryFilter::class)
    ->where('filterUrl', '.*')
    ->name('category-filter');
