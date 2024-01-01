@extends('layouts.main')

@section('content')
    <div class="flex">
        <!-- Left Sidebar (40%) -->
        <div class="w-96 border">
            Left Bar
        </div>

        <!-- Right Content (60%) -->
        <div class="flex-1">
            <div class="grid-cols-4 border border-l-0 p-4">Top bar</div>
            <div class="grid grid-cols-4 grid-flow-row">
                @foreach($products as $productItem)
                    <x-entities.product-card class="border-l-0 border-t-0" :productItem="$productItem" />
                @endforeach
            </div>
            <div class="flex justify-center my-10">{{$products->onEachSide(0)->links()}}</div>
        </div>
    </div>
@endsection
