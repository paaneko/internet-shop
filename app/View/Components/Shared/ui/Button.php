<?php

declare(strict_types=1);

namespace App\View\Components\Shared\ui;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type;

    public string $color;

    public function __construct(string $color = 'default', string $type = 'filled')
    {
        $this->color = $color;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.shared.ui.button');
    }
}
