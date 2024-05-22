<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<div class="container navbar bg-base-100 py-8">
    <div class="navbar-start">
        <a class="btn btn-ghost text-2xl">YOURBRAND.COM</a>
    </div>
    <div class="navbar-center space-x-8">
        <div class="btn btn-md rounded-none">Product catalogue</div>
        <div class="join">
            <div>
                <div>
                    <input class="input join-item input-bordered w-[700px] rounded-none" placeholder="Search" />
                </div>
            </div>
            <div class="indicator">
                <button class="btn join-item rounded-none">Search</button>
            </div>
        </div>
    </div>
    <div class="navbar-end">
        <div @click="$dispatch('open-cart-modal')" class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-circle btn-ghost">
                <div class="indicator">
                    @svg('gmdi-shopping-cart', 'h-6 w-6')
                    <span class="badge indicator-item badge-sm">8</span>
                </div>
            </div>
        </div>
        @auth()
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="avatar btn btn-circle btn-ghost">
                    <div class="w-10 rounded-full">
                        @svg('gmdi-logo-dev-o')
                    </div>
                </div>
                <ul
                    tabindex="0"
                    class="menu dropdown-content menu-sm z-[1] mt-3 w-52 rounded-box bg-base-100 p-2 shadow"
                >
                    <li>
                        <a href="/profile" class="justify-between">
                            Profile
                            <span class="badge">New</span>
                        </a>
                    </li>
                    <li wire:click="logout">
                        <a>{{ __('Log Out') }}</a>
                    </li>
                </ul>
            </div>
        @else
            <a
                href="{{ route('login') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500"
                wire:navigate
            >
                Log in
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm focus:outline focus:outline-2 focus:outline-red-500"
                    wire:navigate
                >
                    Register
                </a>
            @endif

            {{-- <span><a class="link ml-5" href="/login">Login</a></span> --}}
            {{-- <span class="mx-2">or</span> --}}
            {{-- <span><a class="link" href="/register">Register</a></span> --}}
        @endauth
    </div>
    <livewire:modal.cart />
</div>
