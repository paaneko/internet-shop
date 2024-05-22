<div class="mt-10 grid grid-flow-col grid-cols-6 border-l">
    @foreach ($variations as $variation)
        <livewire:product.product-card :$variation />
    @endforeach
</div>
