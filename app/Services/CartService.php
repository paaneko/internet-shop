<?php

namespace App\Services;

use App\Listeners\StripeEventListener;
use App\Models\User;
use App\Models\Variation;
use DB;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use RuntimeException;

class CartService
{
    public const NAME = 'cart';

    private SessionManager $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function addItem(int $variationId): void
    {
        $cartData = $this->session->get(self::NAME);
        $variation = Variation::findOrFail($variationId);

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
        $this->updateSession($cartData);
    }

    public function removeItem(int $variationId): void
    {
        $cartData = $this->session->get(self::NAME);

        $variation = Variation::findOrFail($variationId);

        if (! isset($cartData[$variation->id])) {
            throw new RuntimeException('This variation not found in cart');
        }

        if ($cartData[$variation->id]['quantity'] == 1) {
            unset($cartData[$variation->id]);
        } else {
            $cartData[$variation->id]['quantity'] -= 1;
        }

        /** Updating the session data */
        $this->updateSession($cartData);
    }

    public function removeItemEntirely(int $variationId): void
    {
        $cartData = $this->getItems();

        $variation = Variation::findOrFail($variationId);

        if (! isset($cartData[$variation->id])) {
            throw new RuntimeException('This variation not found in cart');
        }

        unset($cartData[$variation->id]);

        /** Updating the session data */
        $this->updateSession($cartData);
    }

    public function removeCartEntirely(): void
    {
        $this->session->put(self::NAME, []);
        $this->session->save();
    }

    public function isItemInCart(int $variationId): bool
    {
        return isset($this->getItems()[$variationId]);
    }

    public function getItems(): array
    {
        return $this->session->get(self::NAME, []);
    }

    private function updateSession(array $cartData): void
    {
        $this->session->put(self::NAME, $cartData);
        $this->session->save();
    }

    public function removeCartEntirelyByUser(User $user): void
    {
        /**
         * Here I'm changing session data directly in database,
         * because when this method called in Event Listener,
         * handle method can't initialize session from database,
         * so if I log $this->session->getItems it would return
         * empty array, even if session have data.
         *
         * Or I do not find the way, how I can tell laravel use
         * particular session.
         *
         * @see StripeEventListener
         */
        $sessionRow = DB::table('sessions')->where('user_id', $user->id)->first(
        );

        if ($sessionRow) {
            $sessionData = unserialize(
                base64_decode($sessionRow->payload)
            );

            if (isset($sessionData[self::NAME])) {
                unset($sessionData[self::NAME]);
            }

            DB::table('sessions')->where('user_id', $user->id)->update([
                'payload' => base64_encode(serialize($sessionData)),
            ]);
        } else {
            throw new \Exception(
                'User do not have a session or the session has expired'
            );
        }
    }
}
