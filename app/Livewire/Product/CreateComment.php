<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateComment extends Component
{
    #[Locked]
    public $slug;

    #[Rule('required|max:255|min:2')]
    public $username = '';

    #[Rule('required|max:1000')]
    public $body = '';

    /** Model binding by `slug`  */
    public function save(Product $product): void
    {
        $this->validate();

        $product->comments()->create([
            'username' => $this->username,
            'body' => $this->body,
        ]);

        session()->flash('success', 'Your comment was added successfully!');

        redirect()->to('/p/'.$product->slug);
    }

    public function render()
    {
        return view('livewire.product.create-comment');
    }
}
