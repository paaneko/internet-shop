@php
    $parentCategory = $product->categories->sortBy('sorting_order')->first()->parent;
    $category = $product->categories->sortBy('sorting_order')->first();
@endphp

@extends('layouts.main')

@section('content')
    <div class="text-xs breadcrumbs mb-2">
        <ul>
            <li><a href="/">Home</a></li>
            @if($parentCategory != null)
                <li>
                    <a href="/{{$parentCategory->slug}}">{{ $parentCategory->name }}</a>
                </li>
            @endif
            <li><a href="/{{$category->slug}}">{{ $category->name }}</a></li>
            <li>{{ $variation->name }}</li>
        </ul>
    </div>
    <h1 class="text-3xl font-medium mb-4 pb-[1px]">{{$variation->name}}</h1>
    <div role="tablist" class="tabs tabs-bordered rounded-none mb-[-1px] w-[550px] ">
        <a role="tab" class="tab tab-active">Overview</a>
        <a role="tab" class="tab">Specs</a>
        <a role="tab" class="tab">Reviews</a>
        <a role="tab" class="tab">Q & A</a>
        <a role="tab" class="tab">Video</a>
    </div>
    <div class="flex">
        <!-- Left Sidebar (40%) -->
        <div class="p-6 min-w-[550] border border-r-0 leading-none">
            <div class="absolute">
                <span class=" text-xs text-gray-400">Product code</span>
                <br>
                <span class="font-medium">{{ $variation->sku }}</span>
            </div>
            <figure class="flex justify-center mt-14">
                @if(! $variation->getFirstMedia())
                    @svg('gmdi-hide-image-tt', 'mb-4 w-[500px] h-[500px] text-lime-600')
                @else
                    {{ $mainMedia('main') }}
                @endif
            </figure>
        </div>

        <!-- Right Content (60%) -->
        <div class="flex-1">
            <x-entities.product-full-card :$variation />
        </div>
    </div>
    <div class="pt-28 w-[60%]">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Characteristics</strong>
            {{ $variation->name }}
        </h3>
        @foreach($variation->groupedVariationCharacteristics() as $groupName => $characteristics)
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
            {{ $variation->name }}
        </h3>
        <livewire:product.create-comment :variationSlug="$variation->slug" />
        {{--        <x-entities.product-comment-form :slug="$product->slug" />--}}
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
    {{--    <div class="pt-28">--}}
    {{--        <h3 class="text-2xl text-gray-500">--}}
    {{--            <strong class="text-black">Analogues</strong>--}}
    {{--            {{ $variation->name }}--}}
    {{--        </h3>--}}
    {{--        <livewire:product.analogues-list :products="$productRecommendations" />--}}
    {{--    </div>--}}
    <div class="mt-28">
        <h3 class=" text-2xl text-gray-500">
            <strong class="text-black">Frequently asked questions about</strong>
            {{ $variation->name }}
        </h3>
        <div class="pt-10 join join-vertical rounded-none w-[60%]">
            @foreach($productFaqs as $faq)
                <x-entities.faq :$faq />
            @endforeach
        </div>
    </div>
@endsection
