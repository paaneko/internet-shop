<div class="grid grid-flow-row grid-cols-4">
    @foreach ($variations as $variation)
        <livewire:product.product-card class="border-l-0 border-t-0" :key="$variation->id" :$variation />
    @endforeach
</div>
