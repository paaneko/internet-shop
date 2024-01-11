<?php

namespace App\Services;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class WishlistService
{
    private const NAME = 'wishlist';

    protected SessionManager $session;

    public function __construct(
        SessionManager $session
    ) {
        $this->session = $session;
    }

    public function addItemToggle($id): void
    {
        $data = $this->getItems();

        if (! $data->contains($id)) {
            $this->session->push(self::NAME, $id);
        } else {
            $this->session->put(
                self::NAME,
                $data->reject(function ($value) use ($id) {
                    return $value === $id;
                })
            );
        }
    }

    protected function getItems(): Collection
    {
        return collect($this->session->get(self::NAME, []));
    }
}
