<form wire:submit="save('{{ $variationSlug }}')" class="mt-10">
    <label>
        <div class="label">
            <span class="label-text text-lg font-semibold">Your name:</span>
        </div>
        <input
            wire:model="username"
            type="text"
            placeholder="Type here"
            class="input input-bordered w-full rounded-none"
        />
        @error('username')
            <div class="label">
                <span class="label-text-alt font-semibold text-error">{{ $message }}</span>
            </div>
        @enderror
    </label>
    <label for="">
        <div class="label mt-4">
            <span class="label-text text-lg font-semibold">Your comment:</span>
        </div>
        <textarea
            wire:model="body"
            name="body"
            class="textarea textarea-bordered w-full rounded-none"
            placeholder="Type something"
        ></textarea>
        @error('body')
            <div class="label">
                <span class="label-text-alt font-semibold text-error">{{ $message }}</span>
            </div>
        @enderror
    </label>
    <div class="flex justify-end">
        <button type="submit" class="btn btn-md bg-lime-500 px-10 text-white hover:bg-lime-600">Submit</button>
    </div>
</form>
