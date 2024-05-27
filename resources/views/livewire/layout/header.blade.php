<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<div class="container flex flex-col rounded-b-md pb-1 pt-5">
    <div class="flex items-center justify-between space-x-8">
        <a href="/" class="btn btn-ghost flex items-center space-x-1 text-2xl">
            @svg('icon-lime', 'h-[46px] w-[46px]')
            <div>
                <span class="leading-none">
                    <span class="text-3xl font-semibold leading-none text-lime-700">LimeTech</span>
                </span>
                <div class="flex text-xs font-medium text-lime-600">Where Tech Meets Fresh</div>
            </div>
        </a>
        <form class="flex flex-grow">
            <label for="default-search" class="sr-only mb-2 text-sm font-medium">Search</label>
            <div class="relative w-full">
                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                    @svg('heroicon-c-magnifying-glass', 'h-5 w-5 text-lime-600')
                </div>
                <input
                    type="search"
                    id="default-search"
                    class="block w-full rounded-md border border-gray-400/70 bg-gray-50 p-[14.5px] ps-10 text-sm text-gray-900"
                    placeholder="Search Products, Brands..."
                    required
                />
                <button
                    type="submit"
                    class="absolute bottom-[7px] end-2 rounded-lg bg-lime-600 px-4 py-2 text-sm font-medium text-white hover:bg-lime-700"
                >
                    Search
                </button>
            </div>
        </form>
        <div class="flex justify-between">
            @auth()
                <x-entities.header.account-auth />
            @else
                <x-entities.header.account-guest />
            @endauth
            <x-entities.header.account-interaction-icons />
        </div>
        <x-shared.ui.modal>
            <x-slot name="body">
                <livewire:modal.cart />
            </x-slot>
        </x-shared.ui.modal>
    </div>
    <div class="mb-1 mt-3 h-[1px] w-full bg-neutral-200/70"></div>
    <div>
        <x-entities.header.categories-bar />
    </div>
</div>
