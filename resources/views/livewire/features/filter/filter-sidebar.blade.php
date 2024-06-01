<div
    @update-url.window="history.pushState(null, '', '/aaaa/aaa');"
    class="relative mx-auto w-full overflow-hidden rounded-md border border-neutral-400/70 bg-white text-sm font-normal"
>
    <div class="p-5 text-xl font-semibold">Product filter</div>

    @foreach ($productFilter->data as $filterGroupName => $filterGroup)
        <div class="mx-4 h-[1px] w-auto bg-neutral-200/70"></div>

        <div x-data="{ open: false }" class="group cursor-pointer">
            <button
                @click="open = ! open"
                class="flex w-full select-none items-center justify-between px-5 py-5 text-left font-medium hover:text-lime-600"
            >
                {{ $filterGroupName }}
                @svg('heroicon-c-chevron-up', 'h-5 w-5 duration-200 ease-out', [':class' => "{ 'rotate-180': open }"])
                {{--
                    TODO add hint значок кароче ты понял
                --}}
            </button>
            <div x-show="open" x-collapse x-cloak>
                <div class="form-control flex flex-col px-3 py-5 pt-0">
                    @foreach ($filterGroup->items as $filterItem)
                        @php
                            $isChecked = $selectedFilterItems->contains($filterItem->slug);
                        @endphp

                        <a
                            wire:navigate
                            href="{{ $isChecked ? session()->previousUrl() : url()->current() . "/{$filterItem->slug}/" }}"
                            class="flex items-center rounded-md py-2 hover:bg-lime-100/70"
                        >
                            <div class="flex h-5 cursor-pointer items-center">
                                <input
                                    name="{{ $filterItem->id }}"
                                    id="{{ $filterItem->id }}"
                                    type="checkbox"
                                    class="peer hidden"
                                    @if($isChecked) checked @endif
                                />
                                <label
                                    for="{{ $filterItem->id }}"
                                    class="ml-2 flex cursor-pointer select-none items-center space-x-4 text-neutral-700 peer-checked:text-neutral-700 peer-checked:[&_.custom-checkbox]:border-lime-600 peer-checked:[&_.custom-checkbox]:bg-lime-600 [&_svg]:scale-0 peer-checked:[&_svg]:scale-100"
                                >
                                    <span
                                        class="custom-checkbox flex h-5 w-5 items-center justify-center rounded border-2 border-neutral-500"
                                    >
                                        @svg('heroicon-s-check', 'h-4 w-4 text-white duration-300 ease-out')
                                    </span>
                                    <div>
                                        <span>{{ $filterItem->name }}</span>
                                        <span class="text-gray-400">({{ $filterItem->count }})</span>
                                    </div>
                                </label>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
