<form wire:submit="save('{{ $variationSlug }}')" class="mt-10">
    <div class="label">
        <span class="label-text text-lg font-semibold">Your name:</span>
    </div>
    <div class="w-full max-w-xs">
        <input
            type="text"
            wire:model="username"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
            placeholder="John"
            required
        />
    </div>
    <label>
        @error('username')
            <div class="label">
                <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
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
            rows="4"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
            placeholder="Write your thoughts here..."
        ></textarea>
        @error('body')
            <div class="label">
                <span class="label-text-alt text-error font-semibold">{{ $message }}</span>
            </div>
        @enderror
    </label>
    <div class="flex justify-end">
        <x-shared.ui.button class="mt-3 border-2 border-lime-500 bg-lime-500 px-4 py-2 text-white hover:bg-lime-600">
            <p>Submit</p>
        </x-shared.ui.button>
    </div>
</form>
