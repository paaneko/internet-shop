<div class="grid grid-cols-4 grid-flow-row">
    @foreach($variations as $variation)
        <livewire:product.product-card
            class="border-l-0 border-t-0"
            :key="$variation->id"
            :$variation
        />
    @endforeach
</div>
