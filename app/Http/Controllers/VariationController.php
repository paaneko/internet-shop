<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Variation;
use Database\Factories\VariationFactory;

class VariationController extends Controller
{
    public function show(Variation $variation)
    {
        $product = $variation->product;
        $variation->load('variationCharacteristics.variationAttributes');

        // TODO optimize this part of code with `with()` and fix N + 1 problem
        return view('pages.variation', [
            'variation' => $variation,
            'relatedVariations' => $product->variations,
            'product' => $variation->product,
            'productFaqs' => $product->faqs,
            'productComments' => $product->comments,
            'mainMedia' => $variation->getFirstMedia(),
            'fakeOverview' => VariationFactory::generateHtmlContent(),
        ]);
    }
}
