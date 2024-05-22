@props([
    'order',
])

<div class="flex flex-grow justify-between">
    <div class="w-[35%] space-y-8 rounded-md bg-gray-100 p-5">
        <h3 class="text-3xl font-bold">Billing Address</h3>
        <div>
            <div class="font-medium text-gray-400">Name:</div>
            <span class="text-xl">{{ $order->user->name }}</span>
        </div>
        <div>
            <div class="font-medium text-gray-400">Email Address:</div>
            <span class="text-xl">{{ $order->user->email }}</span>
        </div>
        <div>
            <div class="font-medium text-gray-400">Address:</div>
            @if ($order->shipping_address['line2'] === null)
                <div class="text-xl">
                    {{ $order->shipping_address->filter(fn ($item) => $item != null)->except('name')->implode(', ') }}
                </div>
            @else
                <div class="text-xl">
                    {{ $order->shipping_address->filter(fn ($item) => $item != null)->except('name', 'line2')->implode(', ') }}
                </div>
                <div class="text-xl">
                    {{ $order->shipping_address->filter(fn ($item) => $item != null)->except('name', 'line1')->implode(', ') }}
                </div>
            @endif
        </div>
        <div>
            <div class="text-lg font-medium text-gray-400">Payment Method:</div>
            <span class="text-xl">Stripe</span>
        </div>
        <div class="my-8 h-[2px] w-full bg-gray-200"></div>
        <div class="flex justify-between">
            <div class="text-xl font-medium text-gray-400">Subtotal</div>
            <div class="text-xl font-medium">${{ $order->amount_subtotal }}</div>
        </div>
        <div class="flex justify-between">
            <div class="text-xl font-medium text-gray-400">Discount</div>
            <div class="text-xl font-medium">${{ $order->amount_discount }}</div>
        </div>
        <div class="my-8 h-[2px] w-full bg-gray-200"></div>
        <div class="flex justify-between">
            <div class="text-2xl font-bold">Total</div>
            <div class="text-2xl font-bold text-lime-700">${{ $order->amount_total }}</div>
        </div>
    </div>
    <div class="w-[60%]">
        <div class="mb-10 space-y-7 rounded-md bg-gray-100 p-5">
            <div class="text-3xl font-bold">Order Summaries</div>
            <div class="grid grid-cols-3 gap-4 text-gray-500">
                <div class="flex flex-col">
                    <span class="font-medium text-gray-400">Order Status</span>
                    <span class="text-xl font-medium text-black">Pending</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-medium text-gray-400">Order ID</span>
                    <span class="text-xl font-medium text-black">{{ $order->order_number }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-medium text-gray-400">Order Date</span>
                    <span class="text-xl font-medium text-black">
                        {{ $order->created_at->format('M j, Y g:i A') }}
                    </span>
                </div>
            </div>
        </div>
        <div class="space-y-2">
            @foreach ($order->items as $index => $orderItem)
                <x-entities.order.order-item :$orderItem :$index />
            @endforeach
        </div>
    </div>
</div>
