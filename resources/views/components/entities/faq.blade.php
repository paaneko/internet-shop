@props([
    'faqs',
])
<div
    x-data="{
        activeAccordion: '',
        setActiveAccordion(id) {
            this.activeAccordion = this.activeAccordion == id ? '' : id
        },
    }"
    class="relative w-full space-y-2"
>
    @foreach ($faqs as $faq)
        <div x-data="{ id: $id('accordion') }" class="group cursor-pointer rounded-md bg-lime-200/70">
            <button
                @click="setActiveAccordion(id)"
                class="flex w-full select-none items-center justify-between p-5 text-left"
            >
                <div class="flex items-center space-x-2">
                    @svg('heroicon-c-question-mark-circle', 'h-6 w-6 text-lime-700')
                    <span class="text-xl font-medium">{{ $faq->question }}?</span>
                </div>
                <svg
                    class="h-8 w-8 duration-300 ease-out"
                    :class="{ '-rotate-[45deg]': activeAccordion==id }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            </button>
            <div x-show="activeAccordion==id" x-collapse x-cloak>
                <div class="p-4 pt-2">
                    {{ $faq->answer }}
                </div>
            </div>
        </div>
    @endforeach
</div>
