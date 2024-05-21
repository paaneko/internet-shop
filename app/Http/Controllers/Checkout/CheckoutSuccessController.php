<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutSuccessController extends Controller
{
    public function __invoke(Request $request)
    {
        $checkoutSessionId = $request->input('checkout_session_id');

        $order = auth()->user()
            ->orders()
            ->with(['user', 'items'])
            ->where(
                'stripe_checkout_session_id',
                $checkoutSessionId
            )->first();

        return view('pages.checkout-success', [
            'order' => $order,
        ]);
    }
}
