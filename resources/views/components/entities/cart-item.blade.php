<div class="w-min-4xl flex items-center justify-between rounded-md bg-gray-100 p-2">
    <div class="flex w-[450px] items-center space-x-2">
        {{ $deleteButton }}
        <div class="relative">
            <img
                class="h-[80px] w-[80px] rounded bg-white p-1"
                src="{{ $item['thumb'] }}"
                alt="{{ $item['name'] }} cart image"
            />
            <div
                style="background-color: {{ $item['color'] }}"
                class="absolute bottom-0 right-0 h-[20px] w-[20px] rounded"
            ></div>
        </div>
        <div class="font-medium">{{ $item['name'] }}</div>
    </div>
    <div class="flex w-[180px] items-center justify-between">
        <div class="flex w-[85px] items-center justify-between rounded bg-white py-1">
            {{ $incrementButton }}
            <span class="text-lg">{{ $item['quantity'] }}</span>
            {{ $decrementButton }}
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
