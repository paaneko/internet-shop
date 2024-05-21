<?php

namespace App\Services;

use App\DTOs\CheckoutService\LineItemDto;
use App\DTOs\CheckoutService\StripeLineItemProductDto;
use App\DTOs\CheckoutService\StripeLineItemsDto;
use App\DTOs\CheckoutService\StripeSessionDto;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Stripe\Collection;

class CheckoutService
{
    private const CURRENCY = 'USD';

    private const ALLOWED_COUNTRIES = ['PL', 'NL', 'FR', 'GR'];

    public function proceedCheckout(array $cartData)
    {
        return auth()->user()->checkout(
            $this->syncCartDataWithDatabase($cartData),
            [
                'success_url' => route('checkout-success')
                    .'?checkout_session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout-cancel'),
                'shipping_address_collection' => [
                    'allowed_countries' => self::ALLOWED_COUNTRIES,
                ],
                'metadata' => [

                    'user_id' => auth()->user()->id,
                ],
            ],
        );
    }

    /** Fetch true data from database, to avoid price faking */
    private function syncCartDataWithDatabase(array $data): array
    {
        $databaseData = Variation::whereIn('id', array_keys($data))
            ->get();

        return $databaseData->map(function (Variation $variation) use ($data) {
            return $this->transferToPaymentItem(
                $variation,
                $data[$variation->id]['quantity']
            );
        })->toArray();
    }

    private function transferToPaymentItem(
        Variation $variation,
        int $quantity
    ): array {
        return [
            'price_data' => [
                'currency' => self::CURRENCY,
                'product_data' => [
                    'name' => $variation->name,
                    'metadata' => [
                        'item_id' => $variation->id,
                        'item_type' => $variation->getMorphClass(),
                        'color' => $variation->color,
                        'sku' => $variation->sku,
                    ],
                ],
                'unit_amount' => ($variation->getRawOriginal('old_price') == 0)
                    ? $variation->getRawOriginal('price')
                    : $variation->getRawOriginal('old_price'),
            ],
            'quantity' => $quantity,
        ];
    }

    public function handle(string $sessionId): void
    {
        DB::transaction(function () use ($sessionId) {
            $sessionDto = $this->retrieveSessionCheckoutData($sessionId);

            $user = User::find($sessionDto->user_id);

            $order = $user->orders()->create([
                'stripe_checkout_session_id' => $sessionDto->id,
                'order_number' => 'OR'.rand(10000, 99999),
                'amount_shipping' => round(
                    floatval($sessionDto->amount_total) / 100,
                    precision: 2
                ),
                'amount_discount' => round(
                    floatval($sessionDto->amount_discount) / 100,
                    precision: 2
                ),
                'amount_subtotal' => round(
                    floatval($sessionDto->amount_subtotal) / 100,
                    precision: 2
                ),
                'amount_total' => round(
                    floatval($sessionDto->amount_total) / 100,
                    precision: 2
                ),
                'billing_address' => [
                    'city' => $sessionDto->city,
                    'country' => $sessionDto->country,
                    'line1' => $sessionDto->line1,
                    'line2' => $sessionDto->line2,
                    'postal_code' => $sessionDto->postal_code,
                    'state' => $sessionDto->state,
                ],
                'shipping_address' => [
                    'name' => $sessionDto->name,
                    'city' => $sessionDto->city,
                    'country' => $sessionDto->country,
                    'line1' => $sessionDto->line1,
                    'line2' => $sessionDto->line2,
                    'postal_code' => $sessionDto->postal_code,
                    'state' => $sessionDto->state,
                ],
            ]);

            $lineItemsDto = $this->retrieveSessionCheckoutLineItems($sessionId);

            /** @var Collection $orderItems */
            $orderItems = $lineItemsDto->data->map(
                function (LineItemDto $lineItemDto) {
                    $productDto = $this->retrieveLineItemProduct($lineItemDto);

                    return new OrderItem([
                        'item_id' => $productDto->item_id,
                        'item_type' => $productDto->item_type,
                        'name' => $productDto->name,
                        'color' => $productDto->color,
                        'sku' => $productDto->sku,
                        // TODO
                        // Here i manually cast data, because i do not know how i can disable
                        // casting while im saving in db while eloquent. If i do not do that
                        // the price would be casted twice, so here im receiving price e.g 26 000,
                        // database would save 2 600 000
                        'price' => round(
                            floatval($lineItemDto->price) / 100,
                            precision: 2
                        ),
                        'quantity' => $lineItemDto->quantity,
                        'discount' => round(
                            floatval($lineItemDto->amount_discount) / 100,
                            precision: 2
                        ),
                        'sub_total' => round(
                            floatval($lineItemDto->amount_subtotal) / 100,
                            precision: 2
                        ),
                        'total' => round(
                            floatval($lineItemDto->amount_total) / 100,
                            precision: 2
                        ),
                    ]);
                }
            );

            $order->items()->saveMany($orderItems);

            app(CartService::class)->removeCartEntirelyByUser($user);
        });
    }

    protected function retrieveSessionCheckoutData(string $sessionId
    ): StripeSessionDto {
        $stripeSession = Cashier::stripe()->checkout->sessions->retrieve(
            $sessionId
        );

        return StripeSessionDto::fromStripeSessionObject($stripeSession);
    }

    protected function retrieveSessionCheckoutLineItems(string $sessionId
    ): StripeLineItemsDto {
        $stripeLineItems = Cashier::stripe()->checkout->sessions->allLineItems(
            $sessionId
        );

        return StripeLineItemsDto::fromStripeCollection($stripeLineItems);
    }

    protected function retrieveLineItemProduct(LineItemDto $lineItem
    ): StripeLineItemProductDto {
        $stripeProduct = Cashier::stripe()->products->retrieve(
            $lineItem->product
        );

        return StripeLineItemProductDto::fromLineItemProduct($stripeProduct);
    }
}
