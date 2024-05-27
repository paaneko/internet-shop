@props(['color' => 'default', 'type' => 'filled'])

@php
    $classes =
        'inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200';
@endphp

<button type="button" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
