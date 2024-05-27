@props([
    'relatedVariations',
    'variation',
])

<div class="flex flex-row items-center space-x-2 pl-1">
    <span class="text-sm text-gray-600/70">Option:</span>
    <div class="font-medium">{{ $variation->name }}</div>
</div>
<div class="mt-2 flex flex-row flex-wrap">
    @foreach ($relatedVariations as $relatedVariation)
        @if ($relatedVariation->id == $variation->id)
            <div class="m-1 flex flex-row items-center space-x-1 rounded border-2 border-lime-500/70 p-2 text-sm">
                <div
                    style="background-color: {{ $relatedVariation->color }}"
                    class="bottom-0 right-0 h-5 w-5 rounded"
                ></div>
                <div class="font-semibold">{{ $relatedVariation->name }}</div>
                <div class="h-full w-[1px] bg-black"></div>
                <div class="font-semibold">
                    ${{ $relatedVariation->old_price == 0 ? $relatedVariation->price : $relatedVariation->old_price }}
                </div>
            </div>
        @else
            <a
                href="/{{ $relatedVariation->slug }}"
                class="m-1 flex cursor-pointer flex-row items-center space-x-1 rounded border border-neutral-200/70 p-2 text-sm hover:border-lime-500/70"
            >
                <div
                    style="background-color: {{ $relatedVariation->color }}"
                    class="bottom-0 right-0 h-5 w-5 rounded"
                ></div>
                <div>{{ $relatedVariation->name }}</div>
                <div class="h-full w-[1px] bg-black"></div>
                <div class="font-semibold">
                    ${{ $relatedVariation->old_price == 0 ? $relatedVariation->price : $relatedVariation->old_price }}
                </div>
            </a>
        @endif
    @endforeach
</div>
