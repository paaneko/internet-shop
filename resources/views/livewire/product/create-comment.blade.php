<form wire:submit="save('{{ $variationSlug }}')" class="mt-10">
    <label>
        <div class="label">
            <span class="label-text font-semibold text-lg">Your name:</span>
        </div>
        <input wire:model="username" type="text" placeholder="Type here"
               class="input input-bordered rounded-none w-full" />
        @error('username')
        <div class="label">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </div>
        @enderror
    </label>
    <label for="">
        <div class="label mt-4">
            <span class="label-text font-semibold text-lg">Your comment:</span>
        </div>
        <textarea wire:model="body" name="body"
                  class="textarea textarea-bordered rounded-none w-full"
                  placeholder="Type something"></textarea>
        @error('body')
        <div class="label">
            <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
        </div>
        @enderror
    </label>
    <div class="flex justify-end">
        <button type="submit" class="btn btn-md px-10 bg-lime-500 text-white hover:bg-lime-600">Submit</button>
    </div>
</form>
