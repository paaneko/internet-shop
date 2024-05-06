<div
    class="{{$isModalOpen ? "overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full" : ""}}">
    @if($isModalOpen)
        <div class="relative p-4 w-full max-w-3xl max-h-full">
            <div wire:click="closeModal" class="fixed top-0 right-0 left-0 bottom-0 bg-black opacity-50 z-40"></div>
            <div class="relative p-4 w-full max-w-3xl max-h-full z-50">
                <!-- Modal content -->
                <div class="relative bg-white rounded-md shadow">
                    <!-- Modal header -->
                    <div class="px-5 pt-5 space-y-4">
                        <div class="flex items-center justify-between p-5 border-b rounded-t">
                            <h3 class="text-2xl ms-3 font-semibold">
                                SHOPPING CART
                            </h3>
                            <button
                                wire:click="closeModal"
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="default-modal">
                                @svg('heroicon-s-x-mark')
                            </button>
                        </div>
                    </div>
                    <!-- Modal body -->

                    <div class="ms-3 p-5 space-y-4">
                        @if($cartItems->isEmpty())
                            <div class="flex py-[55px] flex-col justify-center items-center">
                                <div class="inline text-[100px]">😱</div>
                                <div class="font-bold text-2xl">Your cart is empty</div>
                                <div class="font-medium text-lg mb-8">Hurry up! And fill it out as soon as possible
                                </div>
                            </div>
                        @else
                            <div class="flex ms-3 items-center justify-between">
                                <span class="text-xl font-medium text-gray-600">{{$cartItems->reduce(fn($acc, $next) => $acc + $next['quantity'])}} ITEM's</span>
                                <button
                                    wire:click="removeAll"
                                    type="button"
                                    class="py-2 px-4 ms-3 text-sm text-white font-medium bg-red-500 hover:bg-red-600 rounded-md border">
                                    Remove all
                                </button>
                            </div>
                            <div class="space-y-4 max-h-[350px] overflow-y-auto">
                                @foreach($cartItems as $itemId => $item)
                                    <x-entities.cart-item :$item>
                                        <x-slot name="deleteButton">
                                            <div wire:click="deleteItem({{$itemId}})">
                                                @svg('heroicon-s-trash', 'w-6 h-6 hover:text-red-600 cursor-pointer')
                                            </div>
                                        </x-slot>
                                        <x-slot name="incrementButton">
                                            <span wire:click="addToCart({{$itemId}})"
                                                  class="px-2 text-2xl font-medium cursor-pointer hover:text-lime-500">+</span>
                                        </x-slot>
                                        <x-slot name="decrementButton">
                                            <span wire:click="removeFromCart({{$itemId}})"
                                                  class="px-2 text-2xl font-medium cursor-pointer hover:text-lime-500">-</span>
                                        </x-slot>
                                    </x-entities.cart-item>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex justify-between items-center p-5 border-t border-gray-200 rounded-b">
                        <button
                            wire:click="closeModal"
                            data-modal-hide="default-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-lg font-medium bg-gray-200 hover:bg-gray-300 rounded-md border">
                            Continue shopping
                        </button>
                        <div class="flex items-center space-x-3">
                            <div class="font-medium text-lg">
                                Total:
                                ${{$cartItems->sum(function ($item) {
                                    return ($item['old_price'] == 0) ? $item['price'] * $item['quantity'] : $item['old_price'] * $item['quantity'];}
                                )}}
                            </div>
                            <button type="button"
                                    class="text-white bg-lime-500 hover:bg-lime-600 font-medium rounded-md text-lg px-5 py-2.5 text-center">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
