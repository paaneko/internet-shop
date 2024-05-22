@extends('layouts.app')

@section('layout')
    <livewire:layout.header />
    <div class="container">
        {{ $slot }}
        @if (session()->has('success'))
            <div
                class="fixed left-1/2 top-0 -translate-x-1/2 -translate-y-[-16px] transform"
                x-data="{ show: true }"
                x-init="setTimeout(() => (show = false), 4000)"
                x-show="show"
            >
                <x-shared.flash-alert.success :message="session('success')" />
            </div>
        @endif
    </div>
    @include('widgets.footer')
@endsection
