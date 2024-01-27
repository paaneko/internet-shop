<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Livewire\Pages\ProductFilter;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Spatie\Url\Url;

require __DIR__.'/auth.php';

Route::post('/newsletters', NewsletterController::class);

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/wishlist', function () {
    return view('pages.wishlist');
});
Route::get('/compare-products', function () {
    return view('pages.compare-products');
});

$searching_segment = Url::fromString(url()->current())->getSegment(
    1
);

switch ($searching_segment) {
    case Product::where('slug', $searching_segment)->exists():
        Route::get('/{product:slug}', [ProductController::class, 'show']);
        break;
    default:
        Route::get('/{slug}', ProductFilter::class)->where(
            'slug',
            '.*'
        );
}
