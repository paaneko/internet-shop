@php
    $categories = $product->categories->pluck('slug', 'name')->sortBy('sorting_order');
    $breadcrumbs = $categories->merge([$variation->name => $variation->slug]);
@endphp

@extends('layouts.main')

@section('content')
    <x-shared.ui.breadcrumbs :items="$breadcrumbs">
        <x-slot name="rightBlock">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-400">Product code:</span>
                <span class="text-sm font-medium">{{ $variation->sku }}</span>
            </div>
        </x-slot>
    </x-shared.ui.breadcrumbs>
    <div class="mt-5 flex space-x-5">
        <!-- Left Sidebar (40%) -->
        @if (! $mainMedia('main'))
            @svg('gmdi-hide-image-tt', 'mb-4 h-[500px] w-[500px] text-lime-600')
        @else
            <img class="rounded-md border border-neutral-400/70" src="{{ $mainMedia->getUrl('main') }}" alt />
        @endif

        <!-- Right Content (60%) -->
        <div class="flex w-[55%] flex-grow">
            <livewire:product.variation-action-block :$relatedVariations :$variation />
        </div>
    </div>
    <div class="mt-5 w-[1235px] rounded-md border border-neutral-400/70 bg-white p-5">
        <h3 class="mb-5 text-2xl text-gray-500">
            <strong class="text-black">Overview</strong>
            {{ $variation->name }}
        </h3>
        <div class="mb-5 h-[1px] w-full bg-neutral-200/70"></div>
        <div class="prose max-w-full">{!! $fakeOverview !!}</div>
    </div>
    <div class="mt-5 w-[1235px] rounded-md border border-neutral-400/70 bg-white p-5">
        <h3 class="mb-5 text-2xl text-gray-500">
            <strong class="text-black">Characteristics</strong>
            {{ $variation->name }}
        </h3>
        <div class="h-[1px] w-full bg-neutral-200/70"></div>
        @foreach ($variation->groupedVariationCharacteristics() as $groupName => $characteristics)
            <div class="flex items-center space-x-1 pb-3 pt-6 font-semibold uppercase">
                <div>{{ $groupName }}</div>
                @svg('heroicon-m-information-circle', 'h-5 w-5 text-lime-700')
            </div>
            @foreach ($characteristics as $characteristic)
                @foreach ($characteristic as $characteristicName => $attributes)
                    <div class="variation-characteristic-row flex p-5 text-sm">
                        <div class="flex w-[50%] items-center space-x-1">
                            <span>{{ $characteristicName }}</span>
                            @svg('heroicon-m-information-circle', 'h-5 w-5 text-lime-700')
                        </div>
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
    <div class="mt-5 w-[1235px] rounded-md border border-neutral-400/70 bg-white p-5">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Comments</strong>
            {{ $variation->name }}
        </h3>
        <div class="my-5 h-[1px] w-full bg-neutral-200/70"></div>
        <div class="flex h-[250px] flex-row space-x-8">
            <x-shared.ui.rating-advanced />
            <div class="h-full w-[1px] bg-neutral-200/70"></div>
            <div class="flex flex-col">
                <div class="py-2 font-medium">Customer Images</div>
                <div class="flex flex-row space-x-3">
                    @foreach ($relatedVariations->take(4) as $ratingVarImage)
                        <img
                            class="h-[180px] w-[185px] rounded-md border border-neutral-300/70"
                            src="{{ $ratingVarImage->getFirstMedia()->getUrl('thumb') }}"
                            alt
                        />
                    @endforeach
                </div>
                <div class="flex flex-grow items-end space-x-1 text-sm font-medium text-gray-500">
                    <span>All customer images are secure saved and encrypted</span>
                    @svg('heroicon-m-information-circle', 'h-5 w-5 text-lime-700')
                </div>
            </div>
        </div>
        <div class="my-5 mt-8 h-[1px] w-full bg-neutral-200/70"></div>
        <livewire:product.create-comment :variationSlug="$variation->slug" />
        {{-- <x-entities.product-comment-form :slug="$product->slug" /> --}}
        <div class="mt-10 space-y-5">
            @if ($productComments->isEmpty())
                <div class="rounded-md border border-neutral-200/70 bg-gray-100 p-8 text-center">
                    No comments yet. Be the first to comment!
                </div>
            @endif

            @foreach ($productComments as $comment)
                <x-entities.variation-comment :$comment />
            @endforeach
        </div>
    </div>
    <div class="mt-5 w-[1235px] rounded-md border border-neutral-400/70 bg-white p-5">
        <h3 class="text-2xl text-gray-500">
            <strong class="text-black">Frequently asked questions about</strong>
            {{ $variation->name }}
        </h3>
        <div class="my-5 mb-8 h-[1px] w-full bg-neutral-200/70"></div>
        <x-entities.faq :faqs="$product->faqs" />
    </div>
@endsection
