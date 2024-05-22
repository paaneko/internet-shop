<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Variation;

class VariationController extends Controller
{
    public function show(Variation $variation)
    {
        $product = $variation->product;

        // TODO optimize this part of code with `with()` and fix N + 1 problem
        return view('pages.variation', [
            'variation' => $variation,
            'product' => $product,
            'productRecommendations' => $product->productRecommendations->take(
                4
            ),
            'productFaqs' => $product->faqs,
            'productComments' => $product->comments,
            'mainMedia' => $variation->getFirstMedia(),
        ]);
    }
}
