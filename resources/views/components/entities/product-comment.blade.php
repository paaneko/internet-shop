@props([
    'comment',
])

<x-shared.ui.rating-comment
    :title="fake()->sentence"
    :name="$comment->username"
    :time="$comment->created_at->diffForHumans()"
    :text="$comment->body"
/>
