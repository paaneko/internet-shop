<div class="flex space-x-5">
    <!-- Left Sidebar (40%) -->
    <div class="w-96 rounded-md border border-neutral-400/70 bg-white"></div>

    <!-- Right Content (60%) -->
    <div class="flex-1">
        <x-shared.ui.product-list-wrapper>
            @foreach ($variations as $variation)
                <livewire:product.product-card class="border-l-0 border-t-0" :key="$variation->id" :$variation />
            @endforeach
        </x-shared.ui.product-list-wrapper>
    </div>
</div>
