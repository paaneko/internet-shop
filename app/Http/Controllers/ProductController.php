<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('pages.products', [
            'products' => Product::paginate(16),
        ]);
    }

    public function show(Product $product): View
    {
        // TODO optimize this part of code with `with()` and fix N + 1 problem
        return view('pages.product', [
            'product' => $product,
            'productRecommendations' => $product->productRecommendations->take(
                4
            ),
            'productFaqs' => $product->faqs,
            'productComments' => $product->comments,
        ]);
    }
}
