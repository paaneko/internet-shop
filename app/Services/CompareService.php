<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class CompareService
{
    private const NAME = 'compare';

    protected SessionManager $session;

    public function __construct(
        SessionManager $session
    ) {
        $this->session = $session;
    }

    public function addItemToggle($variationId): void
    {
        $data = $this->getItems();

        if (! $data->contains($variationId)) {
            $this->session->push(self::NAME, $variationId);
        } else {
            $this->session->put(
                self::NAME,
                $data->reject(function ($value) use ($variationId) {
                    return $value === $variationId;
                })
            );
        }
    }

    public function isItemInCompare(int $variationId): bool
    {
        return $this->getItems()->contains($variationId);
    }

    protected function getItems(): Collection
    {
        return collect($this->session->get(self::NAME, []));
    }
}
