<x-shared.ui.profile-button title="Welcome" user-name="Sign-in / Register">
    <x-slot name="headerSlot">
        <div class="flex flex-1 justify-center space-x-2 px-2 py-1.5 text-sm font-semibold">
            <a
                href="{{ route('login') }}"
                class="w-[112px] flex-grow cursor-pointer rounded-md border border-neutral-400/70 p-2 text-center hover:border-lime-500 hover:text-lime-600"
            >
                Sign-in
            </a>
            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="w-[112px] flex-grow cursor-pointer rounded-md border border-neutral-400/70 p-2 text-center hover:border-lime-500 hover:text-lime-600"
                >
                    Register
                </a>
            @endif
        </div>
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
            <span>Shopping Cart</span>
            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘S</span>
        </a>
    </x-slot>
    <x-slot name="secondSlot">
        <a
            href="#_"
            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
            data-disabled
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
                data-disabled
            >
                @svg('heroicon-o-user', 'mr-2 h-5 w-5')
                <span>Personal Account</span>
                @svg('heroicon-c-chevron-right', 'ml-auto h-5 w-5')
            </div>
        </div>
    </x-slot>
    <x-slot name="logoutSlot"></x-slot>
</x-shared.ui.profile-button>
