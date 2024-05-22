@props([
    'orderItem',
    'index',
])

<div class="flex items-center rounded-md bg-gray-100 p-3">
    <div class="mr-3 text-xl font-medium">{{ $index + 1 }}</div>
    <div class="flex flex-grow items-center justify-between">
        <div class="flex items-center">
            <div class="relative mr-3">
                <img
                    class="h-[80px] w-[80px] rounded bg-white p-1"
                    src="{{ $orderItem->item->getFirstMedia()?->getUrl('thumb') }}"
                    alt="order image"
                />
                <div
                    style="background-color: {{ $orderItem->color }}"
                    class="absolute bottom-0 right-0 h-[20px] w-[20px] rounded"
                ></div>
            </div>
            <div class="flex flex-col">
                <div class="text-xl font-medium">{{ $orderItem->name }}</div>
                <div class="text-sm font-medium text-gray-400">SKU: {{ $orderItem->sku }}</div>
            </div>
        </div>
        <div class="flex w-1/3 items-center justify-between">
            <div class="font-medium">{{ $orderItem->quantity }} x ${{ $orderItem->price }}</div>
            <div class="text-xl font-medium">${{ $orderItem->total }}</div>
        </div>
    </div>
</div>
