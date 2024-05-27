@props([
    'name',
    'title',
    'time',
    'text',
])
<article class="rounded-md border border-neutral-200/70 p-2">
    <div class="mb-4 flex items-center">
        <div class="relative me-4 h-12 w-12 overflow-hidden rounded-md bg-gray-100">
            <svg
                class="absolute -left-1 h-14 w-14 text-lime-700/70"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                    clip-rule="evenodd"
                ></path>
            </svg>
        </div>
        <div class="font-medium">
            <span class="text-lg font-semibold">{{ $name }}</span>
            <div class="flex space-x-1">
                @svg('heroicon-c-check-badge', 'h-5 w-5 text-green-600')
                <span class="text-sm text-green-600">Verified Owner</span>
            </div>
        </div>
    </div>
    <div class="mb-1 flex items-center">
        @svg('heroicon-c-star', 'h-5 w-5 text-yellow-400')
        @svg('heroicon-c-star', 'h-5 w-5 text-yellow-400')
        @svg('heroicon-c-star', 'h-5 w-5 text-yellow-400')
        @svg('heroicon-c-star', 'h-5 w-5 text-yellow-400')
        @svg('heroicon-c-star', 'h-5 w-5 text-yellow-400')
        <h3 class="ms-2 text-sm font-semibold text-gray-900">{{ $title }}</h3>
    </div>
    <footer class="mb-5 text-sm text-gray-500">
        <p>
            Reviewed in the United States on
            <time>{{ $time }}</time>
        </p>
    </footer>
    <p class="mb-3 text-gray-600">
        {{ $text }}
    </p>
    <a href="#" class="mb-5 block text-sm font-medium text-lime-600 hover:underline">Read more</a>
    <aside>
        <p class="mt-1 text-xs text-gray-500">19 people found this helpful</p>
        <div class="mt-3 flex items-center">
            <a
                href="#"
                class="rounded-lg border border-gray-200 bg-white px-2 py-1.5 text-xs font-medium text-gray-900 hover:bg-gray-100 hover:text-lime-700"
            >
                Helpful
            </a>
            <a
                href="#"
                class="ms-4 border-s border-gray-200 ps-4 text-sm font-medium text-lime-600 hover:underline md:mb-0"
            >
                Report abuse
            </a>
        </div>
    </aside>
</article>
