@props([
    'items',
])
<nav class="flex justify-between rounded-md border border-neutral-400/70 bg-white px-3.5 py-1">
    <ol
        class="text-normal mb-3 inline-flex items-center space-x-1 text-sm text-neutral-500 sm:mb-0 [&_.active-breadcrumb]:font-medium [&_.active-breadcrumb]:text-neutral-600"
    >
        <li class="flex h-full items-center">
            <a href="/" class="py-1 hover:text-neutral-900">
                @svg('heroicon-s-home', 'h-5 w-5 text-lime-600 hover:text-lime-700')
            </a>
        </li>
        @foreach ($items as $name => $href)
            @svg('heroicon-m-chevron-right', 'h-5 w-5 text-lime-600')
            @if ($loop->last)
                <li>
                    <a
                        class="active-breadcrumb inline-flex cursor-default items-center rounded py-1 font-normal focus:outline-none"
                    >
                        {{ $name }}
                    </a>
                </li>
            @else
                <li>
                    <a
                        href="{{ $href }}"
                        class="inline-flex items-center py-1 font-normal hover:text-neutral-900 focus:outline-none"
                    >
                        {{ $name }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
    {{ $rightBlock }}
</nav>
