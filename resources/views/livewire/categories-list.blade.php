<div class="grid grid-cols-4 border border-l-0 p-4">
    @foreach ($categories as $category)
        <a class="link" href="{{ asset($category->slug) }}">{{ $category->name }}</a>
    @endforeach
</div>
