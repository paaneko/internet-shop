<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;

class ProductCommentController extends Controller
{
    public function store(Product $product)
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'body' => 'required|max:1000',
        ]);

        $product->comments()->create([
            'username' => request('username'),
            'body' => request('body'),
        ]);

        session()->flash('success', 'Your comment was added successfully!');

        return back();
    }
}
