@extends('layouts.main')

@section('content')
    @if($order != null)
        <div class="flex flex-col flex-grow mt-10">
            <div>
                <div class="mb-20 pb-10 flex flex-col items-center space-y-2 bg-lime-400 w-full rounded-md">
                    @svg('heroicon-o-check-circle', 'w-[250px] h-[250px] text-white ')
                    <h2 class="pb-2 font-bold text-5xl">Payment Successful</h2>
                    <span class="font-semibold text-2xl">Thanks for making purchase!</span>
                    <span class="font-medium text-lg">You can check your order details below 👇</span>
                    <div>
                        <button class="mt-3 flex items-center p-3 bg-white rounded-md hover:bg-gray-100">
                            <span class="mr-1 text-lg font-medium">Continue Shopping</span>
                        </button>
                    </div>
                </div>
            </div>
            <x-entities.order.order-summarie :$order />
        </div>
    @else
        <div class="flex flex-col flex-grow mt-10">
            <div>
                <div class="mb-20 pb-10 flex flex-col items-center space-y-2 bg-lime-400 w-full rounded-md">
                    @svg('heroicon-o-check-circle', 'w-[250px] h-[250px] text-white ')
                    <h2 class="pb-2 font-bold text-5xl">Payment Successful</h2>
                    <span class="font-semibold text-2xl">Thanks for making purchase!</span>
                    <span class="font-medium text-lg">We processing your order, wait little bit 🙌</span>
                    <div class="flex space-x-2" x-data @load.window="setTimeout(() => window.location.reload(), 5000)">
                        <button @click="window.location.reload()"
                                class="mt-3 flex items-center p-3 bg-white rounded-md  hover:bg-gray-100">
                            <span class="mr-1  text-lg font-medium">Re-Check Order</span>
                        </button>
                        <button class="mt-3 flex items-center p-3 bg-white rounded-md  hover:bg-gray-100">
                            <span class="mr-1 text-lg font-medium">Continue Shopping</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex flex-grow justify-between animate-pulse">
                <div class="w-[35%] space-y-8 p-5 bg-gray-100 rounded-md">
                    <div class="mb-6 space-y-8">
                        <div class="h-10 bg-gray-200 rounded w-1/2 mb-4"></div>
                        <div>
                            <div class="h-4 bg-gray-200 rounded w-1/4 mb-2"></div>
                            <div class="h-5 bg-gray-200 rounded w-3/4 mb-2"></div>
                        </div>
                        <div>
                            <div class="h-4 bg-gray-200 rounded w-1/4 mb-2"></div>
                            <div class="h-6 bg-gray-200 rounded w-3/4 mb-2"></div>
                        </div>
                        <div>
                            <div class="h-4 bg-gray-200 rounded w-1/4 mb-2"></div>
                            <div class="h-6 bg-gray-200 rounded w-3/4 mb-2"></div>
                        </div>
                        <div>
                            <div class="h-4 bg-gray-200 rounded w-1/4 mb-2"></div>
                            <div class="h-6 bg-gray-200 rounded w-3/4 mb-2"></div>
                        </div>
                        <div>
                            <div class="h-6 bg-gray-200 rounded w-full mb-2"></div>
                        </div>
                        <div>
                            <div class="h-6 bg-gray-200 rounded w-full mb-2"></div>
                        </div>
                        <div>
                            <div class="h-10 bg-gray-200 rounded w-full mb-2"></div>
                        </div>
                    </div>
                </div>
                <div class="w-[60%]">
                    <div>
                        <div class="p-5 bg-gray-100 rounded-md mb-10 ">
                            <div class="h-10 bg-gray-200 rounded w-1/4 mb-4"></div>
                            <div class="h-8 bg-gray-200 rounded w-full mb-2"></div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-1/6"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-1/6"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-1/6"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-1/6"></div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 bg-gray-200 rounded"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                                </div>
                                <div class="h-4 bg-gray-200 rounded w-1/6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
