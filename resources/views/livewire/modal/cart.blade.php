<div class="relative">
    <!-- Modal content -->
    <!-- Modal header -->
    <div class="space-y-4 px-5 pt-5">
        <div class="flex items-center justify-between rounded-t border-b p-5">
            <h3 class="ms-3 text-2xl font-semibold">SHOPPING CART</h3>
            <button
                x-on:click="$dispatch('toggle-cart-modal')"
                type="button"
                class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-md bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                data-modal-hide="default-modal"
            >
                @svg('heroicon-s-x-mark')
            </button>
        </div>
    </div>
    <!-- Modal body -->

    <div class="ms-3 space-y-4 p-5">
        @if ($cartItems->isEmpty())
            <div class="flex flex-col items-center justify-center py-[55px]">
                <div class="inline text-[100px]">😱</div>
                <div class="text-2xl font-bold">Your cart is empty</div>
                <div class="mb-8 text-lg font-medium">Hurry up! And fill it out as soon as possible</div>
            </div>
        @else
            <div class="ms-3 flex items-center justify-between">
                <span class="text-xl font-medium text-gray-600">
                    {{ $cartItems->reduce(fn ($acc, $next) => $acc + $next['quantity']) }}
                    ITEM's
                </span>
                <button
                    wire:click="removeAll"
                    type="button"
                    class="ms-3 rounded-md border bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600"
                >
                    Remove all
                </button>
            </div>
            <div class="max-h-[350px] space-y-4 overflow-y-auto">
                @foreach ($cartItems as $itemId => $item)
                    <x-entities.cart-item :$item>
                        <x-slot name="deleteButton">
                            <div wire:click="deleteItem({{ $itemId }})">
                                @svg('heroicon-s-trash', 'h-6 w-6 cursor-pointer hover:text-red-600')
                            </div>
                        </x-slot>
                        <x-slot name="incrementButton">
                            <span
                                wire:click="addToCart({{ $itemId }})"
                                class="cursor-pointer px-2 text-2xl font-medium hover:text-lime-500"
                            >
                                +
                            </span>
                        </x-slot>
                        <x-slot name="decrementButton">
                            <span
                                wire:click="removeFromCart({{ $itemId }})"
                                class="cursor-pointer px-2 text-2xl font-medium hover:text-lime-500"
                            >
                                -
                            </span>
                        </x-slot>
                    </x-entities.cart-item>
                @endforeach
            </div>
        @endif
    </div>
    <!-- Modal footer -->
    <div class="flex items-center justify-between rounded-b border-t border-gray-200 p-5">
        <button
            x-on:click="$dispatch('toggle-cart-modal')"
            data-modal-hide="default-modal"
            type="button"
            class="ms-3 rounded-md border bg-gray-200 px-5 py-2.5 text-lg font-medium hover:bg-gray-300"
        >
            Continue shopping
        </button>
        <div class="flex items-center space-x-3">
            <div class="text-lg font-medium">
                Total:
                ${{
                    $cartItems->sum(function ($item) {
                        return $item['old_price'] == 0 ? $item['price'] * $item['quantity'] : $item['old_price'] * $item['quantity'];
                    })
                }}
            </div>
            @auth()
                <button
                    wire:click="checkout"
                    type="button"
                    class="rounded-md bg-lime-500 px-5 py-2.5 text-center text-lg font-medium text-white hover:bg-lime-600"
                >
                    Checkout
                </button>
            @else()
                <a
                    href="{{ route('login') }}"
                    type="button"
                    class="rounded-md bg-lime-500 px-5 py-2.5 text-center text-lg font-medium text-white hover:bg-lime-600"
                >
                    Auth To Checkout
                </a>
            @endauth
        </div>
    </div>
</div>
