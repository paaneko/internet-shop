<div class="w-min-4xl flex justify-between items-center p-2 bg-gray-100 rounded-md">
    <div class="flex w-[450px] items-center space-x-2">
        {{$deleteButton}}
        <div class="relative">
            <img class="w-[80px] h-[80px] p-1 bg-white rounded"
                 src="{{ $item['thumb'] }}"
                 alt="{{ $item['name'] }} cart image" />
            <div
                style="background-color: {{$item['color']}};"
                class="absolute bottom-0 right-0 w-[20px] h-[20px] rounded"></div>
        </div>
        <div class="font-medium ">{{$item['name']}}</div>
    </div>
    <div class="w-[180px] flex justify-between items-center">
        <div class="flex items-center justify-between py-1 rounded bg-white w-[85px]">
            {{$incrementButton}}
            <span class="text-lg">{{$item['quantity']}}</span>
            {{$decrementButton}}
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

