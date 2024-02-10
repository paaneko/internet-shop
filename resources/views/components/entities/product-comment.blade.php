@props(['comment'])


<div class="border">
    <div class="flex py-5 px-8 justify-between bg-gray-100">
        <div class="font-semibold text-lg">{{ $comment->username }}</div>
        <div>{{ $comment->created_at->diffForHumans() }}</div>
    </div>
    <div class="p-5">
        {{ $comment->body }}
    </div>
</div>
