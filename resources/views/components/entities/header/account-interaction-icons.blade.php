<div class="ml-4 flex flex-grow items-center space-x-2">
    <div class="">
        <div tabindex="0" role="button" class="btn btn-circle btn-ghost">
            <div class="relative">
                @svg('icon-clock-history', 'h-7 w-8 hover:text-lime-600')
                <div
                    class="absolute -end-[5px] -top-[8px] inline-flex h-[20px] w-[20px] items-center justify-center rounded-full bg-lime-600 text-xs font-medium text-white"
                >
                    <span class="mt-[1px]">0</span>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div tabindex="0" role="button" class="btn btn-circle btn-ghost">
            <div class="relative">
                @svg('heroicon-o-heart', 'h-7 w-8 hover:text-lime-600')
                <div
                    class="absolute -end-[5px] -top-[8px] inline-flex h-[20px] w-[20px] items-center justify-center rounded-full bg-lime-600 text-xs font-medium text-white"
                >
                    <span class="mt-[1px]">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div tabindex="0" role="button" class="btn btn-circle btn-ghost">
            <div class="relative">
                @svg('heroicon-o-scale', 'h-7 w-8 hover:text-lime-600')
                <div
                    class="absolute -end-[5px] -top-[8px] inline-flex h-[20px] w-[20px] items-center justify-center rounded-full bg-lime-600 text-xs font-medium text-white"
                >
                    <span class="mt-[1px]">0</span>
                </div>
            </div>
        </div>
    </div>
    <div @click="$dispatch('toggle-cart-modal')" class="">
        <div tabindex="0" role="button" class="btn btn-circle btn-ghost">
            <div class="relative">
                @svg('heroicon-o-shopping-bag', 'h-7 w-7 hover:text-lime-600')
                <div
                    class="absolute -end-[5px] -top-[8px] inline-flex h-[20px] w-[20px] items-center justify-center rounded-full bg-lime-600 text-xs font-medium text-white"
                >
                    <span class="mt-[1px]">0</span>
                </div>
            </div>
        </div>
    </div>
</div>
