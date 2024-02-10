<div class="mt-10 grid grid-flow-col grid-cols-6 border-l">
    @foreach($products as $product)
        <livewire:product.product-card :$product />
    @endforeach
</div>
