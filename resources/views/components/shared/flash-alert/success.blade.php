@props(['message'])

<div class="alert alert-success">
    @svg('gmdi-check-circle-o', 'w-6 h-6')
    <span>{{ $message }}</span>
</div>
