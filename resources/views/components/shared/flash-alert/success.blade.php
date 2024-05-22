@props([
    'message',
])

<div class="alert alert-success">
    @svg('gmdi-check-circle-o', 'h-6 w-6')
    <span>{{ $message }}</span>
</div>
