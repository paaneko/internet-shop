@props([
    'label',
])

<div x-data="{ open: true }" class="group cursor-pointer">
    <button
        @click="open = ! open"
        class="flex w-full select-none items-center justify-between px-5 py-5 text-left font-medium hover:text-lime-600"
    >
        <span class="flex">
            {{ $label }}
            @svg('heroicon-m-information-circle', 'ml-1 h-5 w-5 text-lime-700')
        </span>
        @svg('heroicon-c-chevron-up', 'h-5 w-5 duration-200 ease-out', [':class' => "{ 'rotate-180': open }"])
    </button>
    <div x-show="open" x-collapse x-cloak>{{ $slot }}</div>
</div>
