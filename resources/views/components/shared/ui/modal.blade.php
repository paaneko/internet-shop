<div
    @toggle-cart-modal.window="modalOpen = ! modalOpen"
    x-data="{ modalOpen: false }"
    @keydown.escape.window="modalOpen = false"
    :class="{ 'z-40': modalOpen }"
    class="relative h-auto w-auto"
>
    <template x-teleport="body">
        <div
            x-show="modalOpen"
            class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center"
            x-cloak
        >
            <div
                x-show="modalOpen"
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="modalOpen=false"
                class="absolute inset-0 h-full w-full bg-white bg-opacity-70 backdrop-blur-lg"
            ></div>
            <div
                x-show="modalOpen"
                x-trap.inert.noscroll="modalOpen"
                x-transition:enter="duration-300 ease-out"
                x-transition:enter-start="-translate-y-2 opacity-0 sm:scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                x-transition:leave="duration-100 ease-in"
                x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                x-transition:leave-end="-translate-y-2 opacity-0 sm:scale-95"
                class="relative w-full max-w-[900px] rounded-lg border border-neutral-400/70 bg-white shadow-lg"
            >
                {{ $body }}
            </div>
        </div>
    </template>
</div>
