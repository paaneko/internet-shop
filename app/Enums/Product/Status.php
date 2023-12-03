<?php

declare(strict_types=1);

namespace App\Enums\Product;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasColor, HasIcon, HasLabel
{
    case IN_STOCK = 'in-stock';
    case OUT_OF_STOCK = 'out-of-stock';
    case ONLY_A_FEW_REMAINING = 'only-a-few-remaining';
    case ONLY_PRE_ORDER = 'only-pre-order';
    case DISCONTINUED = 'discontinued';

    public function getLabel(): ?string
    {
        /*
         * 🔥 use this for getting constant values `e.g. IN_STOCK` in select form
        */

        // return $this->name;

        // or

        return match ($this) {
            self::IN_STOCK => 'In Stock',
            self::OUT_OF_STOCK => 'Out Of Stock',
            self::ONLY_A_FEW_REMAINING => 'Only A Few Remaining',
            self::ONLY_PRE_ORDER => 'Only Pre-Order',
            self::DISCONTINUED => 'Discontinued',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::IN_STOCK => 'heroicon-m-pencil',
            self::OUT_OF_STOCK => 'heroicon-m-x-mark',
            self::ONLY_A_FEW_REMAINING => 'heroicon-m-battery-50',
            self::ONLY_PRE_ORDER => 'heroicon-m-phone-arrow-down-left',
            self::DISCONTINUED => 'heroicon-m-no-symbol',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IN_STOCK => 'success',
            self::ONLY_A_FEW_REMAINING => 'warning',
            self::OUT_OF_STOCK => 'danger',
            self::ONLY_PRE_ORDER => 'info',
            self::DISCONTINUED => 'gray',
        };
    }
}
