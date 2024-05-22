<?php

declare(strict_types=1);

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class CheckoutCancelController extends Controller
{
    public function __invoke()
    {
        return view('pages.checkout-cancel');
    }
}
