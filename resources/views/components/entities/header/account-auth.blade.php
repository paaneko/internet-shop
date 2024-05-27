<x-shared.ui.profile-button title="Welcome" user-name="{{ auth()->user()->name }}">
    <x-slot name="headerSlot">
        <div class="px-2 py-1.5 text-center text-sm font-semibold">My Account</div>
    </x-slot>
    <x-slot name="fistSlot">
        <a
            href="#_"
            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
        >
            @svg('icon-clock-history', 'mr-2 h-5 w-5')
            <span>Browsing History</span>
            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘U</span>
        </a>
        <a
            href="{{ route('wishlist') }}"
            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
        >
            @svg('heroicon-o-heart', 'mr-2 h-5 w-5')
            <span>Wishlist</span>
            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘K</span>
        </a>
        <a
            href="{{ route('compare') }}"
            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
        >
            @svg('heroicon-o-scale', 'mr-2 h-5 w-5')
            <span>Comparison</span>
            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘B</span>
        </a>
        <a
            @click="$dispatch('toggle-cart-modal')"
            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
        >
            @svg('heroicon-o-shopping-bag', 'mr-2 h-5 w-5')
            <div x-on:click="$dispatch('open-cart-modal')">Shopping Cart</div>
            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘S</span>
        </a>
    </x-slot>
    <x-slot name="secondSlot">
        <a
            href="#_"
            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
        >
            @svg('heroicon-o-truck', 'mr-2 h-5 w-5')
            <span>Order History</span>
            <span class="ml-auto text-xs tracking-widest opacity-60">⌘+H</span>
        </a>
    </x-slot>
    <x-slot name="personalAccountSlot">
        <div class="group relative">
            <div
                class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
            >
                @svg('heroicon-o-user', 'mr-2 h-5 w-5')
                <span>Personal Account</span>
                @svg('heroicon-c-chevron-right', 'ml-auto h-5 w-5')
            </div>
            <div
                data-submenu
                class="invisible absolute right-0 top-0 mr-1 translate-x-full opacity-0 duration-200 ease-out group-hover:visible group-hover:mr-0 group-hover:opacity-100"
            >
                <div
                    class="animate-in slide-in-from-left-1 z-50 w-40 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 shadow-md"
                >
                    <div
                        @click="dropdownOpen=false"
                        class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                    >
                        @svg('icon-profile-card', 'mr-2 h-5 w-5')
                        <span>Profile</span>
                    </div>
                    <div
                        @click="dropdownOpen=false"
                        class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                    >
                        @svg('heroicon-o-newspaper', 'mr-2 h-5 w-5')
                        <span>Newsletter</span>
                    </div>
                    <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                    <div
                        @click="dropdownOpen=false"
                        class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                    >
                        @svg('heroicon-o-plus-circle', 'mr-2 h-5 w-5')
                        <span>More...</span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="logoutSlot">
        <div
            href="#_"
            class="focus:text-accent-foreground relative flex cursor-pointer select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
        >
            @svg('heroicon-o-arrow-right-end-on-rectangle', 'mr-2 h-5 w-5', ['stroke-width' => '1.5'])
            <span wire:click="logout">Log out</span>
            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘Q</span>
        </div>
    </x-slot>
</x-shared.ui.profile-button>
