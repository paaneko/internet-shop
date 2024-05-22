@extends('layouts.main')

@section('content')
    @if ($order != null)
        <div class="mt-10 flex flex-grow flex-col">
            <div>
                <div class="mb-20 flex w-full flex-col items-center space-y-2 rounded-md bg-lime-400 pb-10">
                    @svg('heroicon-o-check-circle', 'w-[250px] h-[250px] text-white ')
                    <h2 class="pb-2 text-5xl font-bold">Payment Successful</h2>
                    <span class="text-2xl font-semibold">Thanks for making purchase!</span>
                    <span class="text-lg font-medium">You can check your order details below 👇</span>
                    <div>
                        <button class="mt-3 flex items-center rounded-md bg-white p-3 hover:bg-gray-100">
                            <span class="mr-1 text-lg font-medium">Continue Shopping</span>
                        </button>
                    </div>
                </div>
            </div>
            <x-entities.order.order-summarie :$order />
        </div>
    @else
        <div class="mt-10 flex flex-grow flex-col">
            <div>
                <div class="mb-20 flex w-full flex-col items-center space-y-2 rounded-md bg-lime-400 pb-10">
                    @svg('heroicon-o-check-circle', 'w-[250px] h-[250px] text-white ')
                    <h2 class="pb-2 text-5xl font-bold">Payment Successful</h2>
                    <span class="text-2xl font-semibold">Thanks for making purchase!</span>
                    <span class="text-lg font-medium">We processing your order, wait little bit 🙌</span>
                    <div class="flex space-x-2" x-data @load.window="setTimeout(() => window.location.reload(), 5000)">
                        <button
                            @click="window.location.reload()"
                            class="mt-3 flex items-center rounded-md bg-white p-3 hover:bg-gray-100"
                        >
                            <span class="mr-1 text-lg font-medium">Re-Check Order</span>
                        </button>
                        <button class="mt-3 flex items-center rounded-md bg-white p-3 hover:bg-gray-100">
                            <span class="mr-1 text-lg font-medium">Continue Shopping</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex flex-grow animate-pulse justify-between">
                <div class="w-[35%] space-y-8 rounded-md bg-gray-100 p-5">
                    <div class="mb-6 space-y-8">
                        <div class="mb-4 h-10 w-1/2 rounded bg-gray-200"></div>
                        <div>
                            <div class="mb-2 h-4 w-1/4 rounded bg-gray-200"></div>
                            <div class="mb-2 h-5 w-3/4 rounded bg-gray-200"></div>
                        </div>
                        <div>
                            <div class="mb-2 h-4 w-1/4 rounded bg-gray-200"></div>
                            <div class="mb-2 h-6 w-3/4 rounded bg-gray-200"></div>
                        </div>
                        <div>
                            <div class="mb-2 h-4 w-1/4 rounded bg-gray-200"></div>
                            <div class="mb-2 h-6 w-3/4 rounded bg-gray-200"></div>
                        </div>
                        <div>
                            <div class="mb-2 h-4 w-1/4 rounded bg-gray-200"></div>
                            <div class="mb-2 h-6 w-3/4 rounded bg-gray-200"></div>
                        </div>
                        <div>
                            <div class="mb-2 h-6 w-full rounded bg-gray-200"></div>
                        </div>
                        <div>
                            <div class="mb-2 h-6 w-full rounded bg-gray-200"></div>
                        </div>
                        <div>
                            <div class="mb-2 h-10 w-full rounded bg-gray-200"></div>
                        </div>
                    </div>
                </div>
                <div class="w-[60%]">
                    <div>
                        <div class="mb-10 rounded-md bg-gray-100 p-5">
                            <div class="mb-4 h-10 w-1/4 rounded bg-gray-200"></div>
                            <div class="mb-2 h-8 w-full rounded bg-gray-200"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 rounded bg-gray-200"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                                    <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                                </div>
                                <div class="h-4 w-1/6 rounded bg-gray-200"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 rounded bg-gray-200"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                                    <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                                </div>
                                <div class="h-4 w-1/6 rounded bg-gray-200"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 rounded bg-gray-200"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                                    <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                                </div>
                                <div class="h-4 w-1/6 rounded bg-gray-200"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 rounded bg-gray-200"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                                    <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                                </div>
                                <div class="h-4 w-1/6 rounded bg-gray-200"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 rounded bg-gray-200"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 w-3/4 rounded bg-gray-200"></div>
                                    <div class="h-4 w-1/2 rounded bg-gray-200"></div>
                                </div>
                                <div class="h-4 w-1/6 rounded bg-gray-200"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
