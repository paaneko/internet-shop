@extends('layouts.app')

@section('layout')
    <livewire:layout.header />
    <div class="container flex flex-grow">
        @yield('content')
        @if(session()->has('success'))
            <div class="fixed top-0 left-1/2 transform -translate-x-1/2 -translate-y-[-16px]"
                 x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 4000)"
                 x-show="show"
            >
                <x-shared.flash-alert.success :message="session('success')" />
            </div>
        @endif
    </div>
    @include('widgets.footer')
@endsection
