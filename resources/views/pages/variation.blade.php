@php
    $parentCategory = $product->categories->sortBy('sorting_order')->first()->parent;
    $category = $product->categories->sortBy('sorting_order')->first();
@endphp

@extends('layouts.main')

@section('content')
    <div class="breadcrumbs mb-2 text-xs">
        <ul>
            <li><a href="/">Home</a></li>
            @if ($parentCategory != null)
                <li>
                    <a href="/{{ $parentCategory->slug }}">{{ $parentCategory->name }}</a>
                </li>
            @endif

            <li><a href="/{{ $category->slug }}">{{ $category->name }}</a></li>
            <li>{{ $variation->name }}</li>
        </ul>
    </div>
    <h1 class="mb-4 pb-[1px] text-3xl font-medium">{{ $variation->name }}</h1>
    <div role="tablist" class="tabs tabs-bordered mb-[-1px] w-[550px] rounded-none">
        <a role="tab" class="tab tab-active">Overview</a>
        <a role="tab" class="tab">Specs</a>
        <a role="tab" class="tab">Reviews</a>
        <a role="tab" class="tab">Q & A</a>
        <a role="tab" class="tab">Video</a>
    </div>
    <div class="flex">
        <!-- Left Sidebar (40%) -->
        <div class="min-w-[550] border border-r-0 p-6 leading-none">
            <div class="absolute">
                <span class="text-xs text-gray-400">Product code</span>
                <br />
                <span class="font-medium">{{ $variation->sku }}</span>
            </div>
            <figure class="mt-14 flex justify-center">
                @if (! $variation->getFirstMedia())
                    @svg('gmdi-hide-image-tt', 'mb-4 h-[500px] w-[500px] text-lime-600')
                @else
                    {{ $mainMedia('main') }}
                @endif
            </figure>
        </div>

        <!-- Right Content (60%) -->
        <div class="flex-1">
            <livewire:product.variation-action-block :$variation />
        </div>
    </div>
    <div class="w-[60%] pt-28">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Characteristics</strong>
            {{ $variation->name }}
        </h3>
        @foreach ($variation->groupedVariationCharacteristics() as $groupName => $characteristics)
            <div class="pt-10 font-semibold uppercase">{{ $groupName }}</div>
            @foreach ($characteristics as $characteristic)
                @foreach ($characteristic as $characteristicName => $attributes)
                    <div class="flex border-b pb-2 pt-6 text-sm">
                        <div class="flex w-[50%] items-center">{{ $characteristicName }}</div>
                        <div class="flex w-[50%] flex-col justify-start">
                            @foreach ($attributes as $attribute)
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
        {{-- <x-entities.product-comment-form :slug="$product->slug" /> --}}
        <div class="mt-10 space-y-5">
            @if ($productComments->isEmpty())
                <div class="border bg-gray-100 p-8 text-center">No comments yet. Be the first to comment!</div>
            @endif

            @foreach ($productComments as $comment)
                <x-entities.product-comment :$comment />
            @endforeach
        </div>
    </div>
    {{-- <div class="pt-28"> --}}
    {{-- <h3 class="text-2xl text-gray-500"> --}}
    {{-- <strong class="text-black">Analogues</strong> --}}
    {{-- {{ $variation->name }} --}}
    {{-- </h3> --}}
    {{-- <livewire:product.analogues-list :products="$productRecommendations" /> --}}
    {{-- </div> --}}
    <div class="mt-28">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Frequently asked questions about</strong>
            {{ $variation->name }}
        </h3>
        <div class="join join-vertical w-[60%] rounded-none pt-10">
            @foreach ($productFaqs as $faq)
                <x-entities.faq :$faq />
            @endforeach
        </div>
    </div>
@endsection
