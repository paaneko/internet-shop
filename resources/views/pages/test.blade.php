@extends('layouts.main')

@section('content')
    @php
        $category = \App\Models\Category::find(1);

        $service = new \App\Services\CategoryFilterService($category, '');

        dd($service->getProductFilters());
    @endphp
@endsection
