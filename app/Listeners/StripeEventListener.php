<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Services\CheckoutService;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'checkout.session.completed') {
            app(CheckoutService::class)->handle(
                $event->payload['data']['object']['id']
            );
        }
    }
}
