<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products');
    }

    public function show(Product $product)
    {
        // TODO optimize this part of code with `with()` and fix N + 1 problem
        return view('pages.product', [
            'product' => $product,
            'productRecommendations' => $product->productRecommendations->take(
                4
            ),
            'productFaqs' => $product->faqs,
            'productComments' => $product->comments,
            'mainMedia' => $product->getFirstMedia(),
        ]);
    }
}
