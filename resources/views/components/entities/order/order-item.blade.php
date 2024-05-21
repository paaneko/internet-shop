@props(['orderItem', 'index'])

<div class="flex items-center p-3 bg-gray-100 rounded-md">
    <div class="mr-3 font-medium text-xl">{{$index + 1}}</div>
    <div class="flex flex-grow justify-between items-center">
        <div class="flex items-center">
            <div class="relative mr-3">
                <img class="w-[80px] h-[80px] p-1 bg-white rounded"
                     src="http://internet-shop.test/storage/media/product/1/conversions/1-thumb.webp"
                     alt="order image" />
                <div
                    style="background-color: {{$orderItem->color}};"
                    class="absolute bottom-0 right-0 w-[20px] h-[20px] rounded"></div>
            </div>
            <div class="flex flex-col">
                <div class="text-xl font-medium">{{$orderItem->name}}</div>
                <div class="text-gray-400 text-sm font-medium">SKU: {{$orderItem->sku}}</div>
            </div>
        </div>
        <div class="w-1/3 flex items-center justify-between">
            <div class="font-medium ">{{$orderItem->quantity}} x ${{$orderItem->price}}</div>
            <div class="font-medium text-xl">${{$orderItem->total }}</div>
        </div>
    </div>
</div>
