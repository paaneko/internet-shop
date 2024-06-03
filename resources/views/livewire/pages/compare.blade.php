<x-shared.ui.product-list-wrapper>
    @foreach ($variations as $variation)
        <livewire:product.product-card class="border-l-0 border-t-0" :key="$variation->id" :$variation />
    @endforeach
</x-shared.ui.product-list-wrapper>
