<?php

declare(strict_types=1);

use App\Http\Controllers\Checkout\CheckoutCancelController;
use App\Http\Controllers\Checkout\CheckoutSuccessController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\VariationController;
use App\Livewire\Pages\CategoryFilter;
use App\Models\Variation;
use Illuminate\Support\Facades\Route;
use Spatie\Url\Url;

require __DIR__ . '/auth.php';

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

Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');
Route::get('/compare', function () {
    return view('pages.compare');
})->name('compare');

$searching_segment = Url::fromString(url()->current())->getSegment(
    1
);

switch ($searching_segment) {
    case Variation::where('slug', $searching_segment)->exists():
        Route::get('/{variation:slug}', [VariationController::class, 'show']);
        break;
    default:
        Route::get('/{url}', CategoryFilter::class)->where(
            'url',
            '.*'
        );
}
