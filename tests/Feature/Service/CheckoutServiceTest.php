<?php

declare(strict_types=1);

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
use function Pest\Laravel\get;

beforeAll(function () {
    define('TEST_STRIPE_CHECKOUT_SESSION_ID', 'test_checkout_session_id');
    define('TEST_CITY', 'test_city');
    define('TEST_COUNTRY', 'test_country');
    define('TEST_LINE', 'test_line');
    define('POSTAL_CODE', 'test_postal_code');

    define('PRODUCT_PRICE', 1000);
    define('PRODUCT_PRICE_WITHOUT_CAST', 100000);

    define('VARIATION_ID', 33);
});

beforeEach(function () {
    $user = User::factory()->create();
    $this->user = $user;

    actingAs($user);

    $variation = VariationFactory::new()
        ->createWithRandomCreatedProduct()
        ->create([
            'id' => VARIATION_ID,
            'price' => PRODUCT_PRICE,
            'old_price' => 0,
        ]);

    $this->variation = $variation;

    $cartService = app(CartService::class);

    $this->cartService = $cartService;

    $this->cartService->addItem($variation->id);

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
                id: TEST_STRIPE_CHECKOUT_SESSION_ID,
                name: 'test_name',
                user_id: "{$this->user->id}",
                amount_shipping: 0,
                amount_discount: 0,
                amount_subtotal: PRODUCT_PRICE_WITHOUT_CAST,
                amount_total: PRODUCT_PRICE_WITHOUT_CAST,
                city: TEST_CITY,
                country: TEST_COUNTRY,
                line1: TEST_LINE,
                line2: null,
                postal_code: POSTAL_CODE,
                state: null
            );
        }

        protected function retrieveSessionCheckoutLineItems(string $sessionId
        ): StripeLineItemsDto {
            return new StripeLineItemsDto(
                data: collect([
                    new LineItemDto(
                        price: PRODUCT_PRICE_WITHOUT_CAST,
                        product: 'test_product_hash',
                        quantity: 1,
                        amount_discount: 0,
                        amount_subtotal: PRODUCT_PRICE_WITHOUT_CAST,
                        amount_total: PRODUCT_PRICE_WITHOUT_CAST,
                    ),
                ])
            );
        }

        protected function retrieveLineItemProduct(LineItemDto $lineItem
        ): StripeLineItemProductDto {
            return new StripeLineItemProductDto(
                name: $this->variation->name,
                item_id: "{$this->variation->id}",
                color: $this->variation->color,
                sku: $this->variation->sku,
                item_type: $this->variation->getMorphClass()
            );
        }
    };

    $this->mock = new $checkoutServiceMock($user, $variation);
});

it('can proceed checkout', function () {
    $this->mock->handle('test_session_id');

    /** Re fetching updated session data from database */
    Session::forget(CartService::NAME);

    $cartItems = $this->cartService->getItems();

    expect(isset($cartItems[$this->variation->id]))->toBeFalse();

    $order = $this->user->orders->firstOrFail();

    expect($order->stripe_checkout_session_id)->toBe(
        TEST_STRIPE_CHECKOUT_SESSION_ID
    )->and($order->items->pluck('item_id'))
        ->toEqual(collect(VARIATION_ID));
});

it('can render checkout-cancel page', function () {
    $response = get('checkout-cancel');

    $response->assertStatus(200);

    $response->assertSee('Payment Unsuccessful');
});

it('can render checkout-success page', function () {
    $response = $this->get(
        '/checkout-success?checkout_session_id=test_session_id'
    );

    $response->assertStatus(200);

    $response->assertSee('Payment Successful');
});

it('properly save and display prices', function () {
    $this->mock->handle('test_session_id');

    Session::forget(CartService::NAME);

    $response = $this->get(
        '/checkout-success?checkout_session_id=' . TEST_STRIPE_CHECKOUT_SESSION_ID
    );

    $response
        ->assertSee('1 x $' . $this->variation->price)
        ->assertSee('$' . PRODUCT_PRICE)
        ->assertDontSee('$' . PRODUCT_PRICE_WITHOUT_CAST);
});

it('properly save and display order info', function () {
    $this->mock->handle('test_session_id');

    Session::forget(CartService::NAME);

    $response = $this->get(
        '/checkout-success?checkout_session_id=' . TEST_STRIPE_CHECKOUT_SESSION_ID
    );

    $response
        ->assertSee($this->variation->name)
        ->assertSee($this->user->name)
        ->assertSee(TEST_CITY)
        ->assertSee(TEST_LINE)
        ->assertSee(TEST_COUNTRY);
});
