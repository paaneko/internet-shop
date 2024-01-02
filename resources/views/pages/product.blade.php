@extends('layouts.main')

@section('content')
    <div class="text-xs breadcrumbs mb-2">
        <ul>
            <li><a href="/">Home</a></li>
            @if($product->categories->sortBy('sorting_order')->first()->parent_id != null)
                <li><a>{{ $product->categories->sortBy('sorting_order')->first()->parent->name }}</a></li>
            @endif
            <li><a>{{ $product->categories->sortBy('sorting_order')->first()->name }}</a></li>
            <li>{{ $product->name }}</li>
        </ul>
    </div>
    <h1 class="text-3xl font-medium mb-4 pb-[1px]">{{$product->name}}</h1>
    <div role="tablist" class="tabs tabs-bordered rounded-none mb-[-1px] w-[600px] ">
        <a role="tab" class="tab tab-active">Overview</a>
        <a role="tab" class="tab">Specs</a>
        <a role="tab" class="tab">Reviews</a>
        <a role="tab" class="tab">Q & A</a>
        <a role="tab" class="tab">Video</a>
    </div>
    <div class="flex">
        <!-- Left Sidebar (40%) -->
        <div class="p-6 w-[600px] border border-r-0 leading-none">
            <span class="text-xs text-gray-400 ">Product code</span>
            <br>
            <span class="font-medium">{{ $product->sku }}</span>
        </div>

        <!-- Right Content (60%) -->
        <div class="flex-1">
            <x-entities.product-full-card :$product />
        </div>
    </div>
    <div class="pt-28 w-[60%]">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Characteristics</strong>
            {{ $product->name }}
        </h3>
        @foreach($product->groupedProductCharacteristics() as $groupName => $characteristics)
            <div class="uppercase font-semibold pt-10">{{ $groupName }}</div>
            @foreach($characteristics as $characteristic)
                @foreach($characteristic as $characteristicName => $attributes)
                    <div class="flex pt-6 pb-2 border-b text-sm">
                        <div class="flex items-center w-[50%] ">{{ $characteristicName }}</div>
                        <div class="flex w-[50%] flex-col justify-start">
                            @foreach($attributes as $attribute)
                                <span>{{ $attribute }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endforeach
    </div>
    <div class="w-[60%] pt-28">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Comments</strong>
            {{ $product->name }}
        </h3>
        <x-entities.product-comment-form :slug="$product->slug" />
        <div class="space-y-5 mt-10">
            @if($productComments->isEmpty())
                <div class="border p-8 text-center bg-gray-100">
                    No comments yet. Be the first to comment!
                </div>
            @endif
            @foreach($productComments as $comment)
                <x-entities.product-comment :$comment />
            @endforeach
        </div>
    </div>
    <div class="pt-28">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Analogues</strong>
            {{ $product->name }}
        </h3>
        <div class="mt-10 grid grid-flow-col grid-cols-6 border-l">
            @foreach($productRecommendations as $productItem)
                <x-entities.product-card class="border-l-0" :$productItem />
            @endforeach
        </div>
    </div>
    <div class="mt-28">
        <h3 class=" text-2xl text-gray-500">
            <strong class="text-black">Frequently asked questions about</strong>
            {{ $product->name }}
        </h3>
        <div class="pt-10 join join-vertical rounded-none w-[60%]">
            @foreach($productFaqs as $faq)
                <x-entities.faq :$faq />
            @endforeach
        </div>
    </div>
@endsection
