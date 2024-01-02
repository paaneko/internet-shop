@props(['slug'])

<form method="post" action="/p/{{ $slug }}/comment" class="mt-10">
    @csrf
    <div class="label">
        <span class="label-text">Your name:</span>
    </div>
    <input name="username" type="text" placeholder="Type here"
           class="input input-bordered rounded-none w-full" />
    <div class="label mt-4">
        <span class="label-text">Your comment:</span>
    </div>
    <textarea name="body" class="textarea textarea-bordered rounded-none w-full"
              placeholder="Type something"></textarea>
    <div class="flex justify-end">
        <button class="btn btn-md px-10 bg-lime-500 text-white hover:bg-lime-600" type="submit">Submit</button>
    </div>
</form>
