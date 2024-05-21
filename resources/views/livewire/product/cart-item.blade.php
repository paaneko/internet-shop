<div class="w-min-4xl flex justify-between items-center p-2 bg-gray-100 rounded-md">
    <div class="flex w-[450px] items-center space-x-2">
        @svg('heroicon-s-trash', 'w-6 h-6 hover:text-red-600 cursor-pointer')
        <div class="relative">
            <img class="w-[80px] h-[80px] p-1 bg-white rounded"
                 src="https://i.moyo.ua/img/products/5241/70_174.jpg?1714991108"
                 alt="cart-item image" />
            <div
                class="absolute bottom-0 right-0 w-[18px] h-[18px] rounded bg-red-500"></div>
        </div>
        <div class="font-medium ">{{$item['name']}}</div>
    </div>
    <div class="w-[200px] flex justify-between items-center">
        <div class="flex items-center justify-between py-1 rounded bg-white w-[85px]">
            <span
                wire:click="addToCart"
                class="px-2 text-2xl font-medium cursor-pointer hover:text-lime-500">+</span>
            <span class="text-lg">{{$item['quantity']}}</span>
            <span
                wire:click="removeFromCart"
                class="px-2 text-2xl font-medium cursor-pointer hover:text-lime-500">-</span>
        </div>
        @if($item['old_price'] == 0)
            <div class="text-lg">${{$item['price'] * $item['quantity']}}</div>
        @else
            <div class="flex justify-end items-end flex-col">
                <div class="text-xs text-gray-500 line-through">${{$item['price'] * $item['quantity']}}</div>
                <div class="text-red-500 font-medium text-lg leading-none">
                    ${{$item['old_price'] * $item['quantity']}}</div>
            </div>
        @endif
    </div>
</div>

