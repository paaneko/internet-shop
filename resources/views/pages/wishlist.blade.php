@extends('layouts.main')

@section('content')
    <div class="flex">
        <!-- Left Sidebar (40%) -->
        <div class="w-96 border">
            Left Sidebar
        </div>

        <!-- Right Content (60%) -->
        <div class="flex-1">
            <div class="grid-cols-4 border border-l-0 p-4">Top bar</div>
            <livewire:pages.wishlist />
        </div>
    </div>
@endsection
