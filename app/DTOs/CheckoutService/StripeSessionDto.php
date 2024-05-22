<?php

declare(strict_types=1);

namespace App\DTOs\CheckoutService;

use Stripe\Checkout\Session;

class StripeSessionDto
{
    public function __construct(
        public string $id,
        public string $name,
        public int $user_id,
        public int $amount_shipping,
        public int $amount_discount,
        public int $amount_subtotal,
        public int $amount_total,
        public string $city,
        public string $country,
        public string $line1,
        public ?string $line2,
        public int $postal_code,
        public ?string $state,
    ) {
    }

    public static function fromStripeSessionObject(Session $session): self
    {
        return new self(
            id: $session->id,
            name: $session->shipping_details->name,
            user_id: $session->metadata->user_id,
            amount_shipping: $session->total_details->amount_shipping,
            amount_discount: $session->total_details->amount_discount,
            amount_subtotal: $session->amount_subtotal,
            amount_total: $session->amount_total,
            city: $session->customer_details->address->city,
            country: $session->customer_details->address->country,
            line1: $session->customer_details->address->line1,
            line2: $session->customer_details->address->line2,
            postal_code: $session->customer_details->address->postal_code,
            state: $session->customer_details->address->state,
        );
    }
}
