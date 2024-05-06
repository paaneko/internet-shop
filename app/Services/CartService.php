<?php

namespace App\Services;

use App\Models\Variation;
use Illuminate\Session\SessionManager;
use RuntimeException;

class CartService
{
    private const NAME = 'cart';

    private SessionManager $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function addItem(int $variationId): void
    {
        $cartData = $this->session->get(self::NAME);
        $variation = Variation::find($variationId);

        if (isset($cartData[$variation->id])) {
            $cartData[$variation->id]['quantity'] += 1;
        } else {
            $cartData[$variationId] = [
                'variationId' => $variationId,
                'name' => $variation->name,
                'quantity' => 1,
                'price' => $variation->price,
                'old_price' => $variation->old_price,
                'color' => $variation->color,
                'thumb' => $variation->getFirstMedia()?->getUrl('thumb'),
            ];
        }

        /** Updating the session data */
        $this->session->put(self::NAME, $cartData);
    }

    public function removeItem(int $variationId): void
    {
        $cartData = $this->session->get(self::NAME);

        $variation = Variation::find($variationId);

        if (! isset($cartData[$variation->id])) {
            throw new RuntimeException('This variation not found in cart');
        }

        if ($cartData[$variation->id]['quantity'] == 1) {
            unset($cartData[$variation->id]);
        } else {
            $cartData[$variation->id]['quantity'] -= 1;
        }

        /** Updating the session data */
        $this->session->put(self::NAME, $cartData);
    }

    public function removeItemEntirely(int $variationId): void
    {
        $cartData = $this->getItems();

        $variation = Variation::find($variationId);

        if (! isset($cartData[$variation->id])) {
            throw new RuntimeException('This variation not found in cart');
        }

        unset($cartData[$variation->id]);

        /** Updating the session data */
        $this->session->put(self::NAME, $cartData);
    }

    public function removeCartEntirely(): void
    {
        $this->session->put(self::NAME, []);
    }

    public function isItemInCart(int $variationId): bool
    {
        return isset($this->getItems()[$variationId]);
    }

    public function getItems(): array
    {
        return $this->session->get(self::NAME, []);
    }
}
