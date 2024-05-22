@props([
    'faq',
])

<div class="collapse join-item collapse-arrow border border-base-300">
    <input type="radio" name="my-accordion-4" checked="checked" />
    <div class="collapse-title text-xl font-medium">
        {{ $faq->question }}
    </div>
    <div class="collapse-content">
        <p>{{ $faq->answer }}</p>
    </div>
</div>
