<?php

use App\DTOs\CheckoutService\LineItemDto;
use App\DTOs\CheckoutService\StripeLineItemProductDto;
use App\DTOs\CheckoutService\StripeLineItemsDto;
use App\DTOs\CheckoutService\StripeSessionDto;
use App\Models\User;
use App\Models\Variation;
use App\Services\CartService;
use App\Services\CheckoutService;
use Database\Factories\VariationFactory;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\actingAs;

it('can proceed checkout', function () {
    $user = User::factory()->create();

    actingAs($user);

    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create([
            'price' => 1000,
            'old_price' => 0,
        ]);

    $cartService = app(CartService::class);

    $cartService->addItem($variation->id);

    /** Mocking methods that returns data from StripeCLI by Cashier layer */
    $checkoutServiceMock = new class($user, $variation) extends CheckoutService
    {
        private User $user;

        private Variation $variation;

        public function __construct($user, $variation)
        {
            $this->user = $user;
            $this->variation = $variation;
        }

        protected function retrieveSessionCheckoutData(string $sessionId
        ): StripeSessionDto {
            return new StripeSessionDto(
                id: 'stripe_checkout_session_id',
                name: 'test_name',
                user_id: $this->user->id,
                amount_shipping: 0,
                amount_discount: 0,
                amount_subtotal: 1000,
                amount_total: 1000,
                city: 'test_city',
                country: 'test_country',
                line1: 'test_line',
                line2: null,
                postal_code: 11111,
                state: null
            );
        }

        protected function retrieveSessionCheckoutLineItems(string $sessionId
        ): StripeLineItemsDto {
            return new StripeLineItemsDto(
                data: collect([
                    new LineItemDto(
                        price: $this->variation->price,
                        product: 'test_product_hash',
                        quantity: 1,
                        amount_discount: 0,
                        amount_subtotal: $this->variation->price,
                        amount_total: $this->variation->price,
                    ),
                ])
            );
        }

        protected function retrieveLineItemProduct(LineItemDto $lineItem
        ): StripeLineItemProductDto {
            return new StripeLineItemProductDto(
                name: $this->variation->name,
                item_id: $this->variation->id,
                item_type: $this->variation->getMorphClass()
            );
        }
    };

    $mock = new $checkoutServiceMock($user, $variation);

    $mock->handle('test_session_id');

    /** Re fetching updated session data from database */
    Session::forget(CartService::NAME);

    $cartItems = $cartService->getItems();

    expect(isset($cartItems[$variation->id]))->toBeFalse();

    $order = $user->orders->firstOrFail();

    expect($order->stripe_checkout_session_id)->toBe(
        'stripe_checkout_session_id'
    )->and($order->items->pluck('id'))
        ->toEqual(collect([$variation->id]));
});
