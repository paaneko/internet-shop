<div x-data="{
    dropdownOpen: false,
}" class="relative">
    <button
        @click="dropdownOpen=true"
        class="inline-flex h-[50px] items-center justify-center rounded-md border border-neutral-400/70 bg-white py-2 pl-2 pr-8 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-100 focus:bg-white focus:outline-none active:bg-white disabled:pointer-events-none disabled:opacity-50"
    >
        <div class="relative h-[34px] w-[34px] overflow-hidden rounded-md bg-neutral-200">
            <svg
                class="absolute -left-0 top-[2.5px] h-[34px] w-[34px] text-lime-700/70"
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
        <div class="ml-2 flex h-full flex-col items-start justify-center leading-none">
            <div class="text-xs text-gray-500/70">{{ $title }}</div>
            <div class="text-xs font-semibold">{{ $userName }}</div>
        </div>
        <svg
            class="absolute right-0 mr-1 h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
            />
        </svg>
    </button>

    <div
        x-show="dropdownOpen"
        @click.away="dropdownOpen=false"
        x-transition:enter="duration-200 ease-out"
        x-transition:enter-start="-translate-y-2"
        x-transition:enter-end="translate-y-0"
        class="absolute left-1/2 top-0 z-50 mt-12 w-56 -translate-x-1/2"
        x-cloak
    >
        <div class="mt-1 rounded-md border border-neutral-200/70 bg-white p-1 text-neutral-700 shadow-md">
            {{ $headerSlot }}
            <div class="mx-2 my-1 h-px bg-neutral-200"></div>
            {{ $fistSlot }}
            <div class="mc mx-2 my-1 h-px bg-neutral-200"></div>
            {{ $secondSlot }}
            {{ $personalAccountSlot }}
            <div class="mx-2 my-1 h-px bg-neutral-200"></div>
            <a
                href="#_"
                class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
            >
                @svg('icon-github', 'mr-2 h-5 w-5')
                <span>GitHub</span>
            </a>
            <a
                href="#_"
                class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
            >
                @svg('icon-gitlab', 'mr-2 h-5 w-5')
                <span>GitLab</span>
            </a>
            <a
                href="#_"
                class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                data-disabled
            >
                @svg('gmdi-api', 'mr-2 h-5 w-5')
                <span>API</span>
            </a>
            <div class="mx-2 my-1 h-px bg-neutral-200"></div>
            {{ $logoutSlot }}
        </div>
    </div>
</div>
