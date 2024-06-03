@extends('layouts.main')

@section('content')
    <div class="flex space-x-5">
        <!-- Left Sidebar (40%) -->
        <div class="w-96 rounded-md border border-neutral-400/70 bg-white"></div>

        <!-- Right Content (60%) -->
        <div class="flex-1">
            <livewire:pages.wishlist />
        </div>
    </div>
@endsection
