@props([
    'comment',
])

<div class="border">
    <div class="flex justify-between bg-gray-100 px-8 py-5">
        <div class="text-lg font-semibold">{{ $comment->username }}</div>
        <div>{{ $comment->created_at->diffForHumans() }}</div>
    </div>
    <div class="p-5">
        {{ $comment->body }}
    </div>
</div>
