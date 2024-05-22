<div class="w-min-4xl flex items-center justify-between rounded-md bg-gray-100 p-2">
    <div class="flex w-[450px] items-center space-x-2">
        @svg('heroicon-s-trash', 'h-6 w-6 cursor-pointer hover:text-red-600')
        <div class="relative">
            <img
                class="h-[80px] w-[80px] rounded bg-white p-1"
                src="https://i.moyo.ua/img/products/5241/70_174.jpg?1714991108"
                alt="cart-item image"
            />
            <div class="absolute bottom-0 right-0 h-[18px] w-[18px] rounded bg-red-500"></div>
        </div>
        <div class="font-medium">{{ $item['name'] }}</div>
    </div>
    <div class="flex w-[200px] items-center justify-between">
        <div class="flex w-[85px] items-center justify-between rounded bg-white py-1">
            <span wire:click="addToCart" class="cursor-pointer px-2 text-2xl font-medium hover:text-lime-500">+</span>
            <span class="text-lg">{{ $item['quantity'] }}</span>
            <span wire:click="removeFromCart" class="cursor-pointer px-2 text-2xl font-medium hover:text-lime-500">
                -
            </span>
        </div>

        @if ($item['old_price'] == 0)
            <div class="text-lg">${{ $item['price'] * $item['quantity'] }}</div>
        @else
            <div class="flex flex-col items-end justify-end">
                <div class="text-xs text-gray-500 line-through">${{ $item['price'] * $item['quantity'] }}</div>
                <div class="text-lg font-medium leading-none text-red-500">
                    ${{ $item['old_price'] * $item['quantity'] }}
                </div>
            </div>
        @endif
    </div>
</div>
