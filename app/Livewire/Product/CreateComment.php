<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\Variation;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateComment extends Component
{
    #[Locked]
    public $variationSlug;

    #[Rule('required|max:255|min:2')]
    public $username = '';

    #[Rule('required|max:1000')]
    public $body = '';

    /** Model binding by `id`  */
    public function save(Variation $variation): void
    {
        $this->validate();

        $variation->product->comments()->create([
            'username' => $this->username,
            'body' => $this->body,
        ]);

        session()->flash('success', 'Your comment was added successfully!');

        redirect()->to('/' . $variation->slug);
    }

    public function render()
    {
        return view('livewire.product.create-comment');
    }
}
