<div class="grid grid-cols-4 grid-flow-row">
    @foreach($products as $product)
        <livewire:product.product-card
            class="border-l-0 border-t-0"
            :key="$product->id"
            :$product
        />
    @endforeach
</div>
