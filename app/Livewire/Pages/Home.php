<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.pages.home')
            ->extends('layouts.main');
    }
}
