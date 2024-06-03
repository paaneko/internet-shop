@props([
    'selectedPriceRange',
    'priceRange',
])
<div class="flex w-full items-center justify-center p-5">
    <div
        x-data="{
            minprice: {{ $selectedPriceRange['min'] }},
            maxprice: {{ $selectedPriceRange['max'] }},
            min: {{ $priceRange->min_price }},
            max: {{ $priceRange->max_price }},
            minthumb: 0,
            maxthumb: 0,
            mintrigger() {
                this.minprice = Math.min(this.minprice, this.maxprice - 100)
                this.minthumb =
                    1 + ((this.minprice - this.min) / (this.max - this.min)) * 100
            },
            maxtrigger() {
                this.maxprice = Math.max(this.maxprice, this.minprice + 100)
                this.maxthumb =
                    104 - ((this.maxprice - this.min) / (this.max - this.min)) * 100
            },
        }"
        x-init="
            mintrigger()
            maxtrigger()
        "
        class="relative w-full max-w-xl"
    >
        <div>
            <input
                type="range"
                step="10"
                x-bind:min="min"
                x-bind:max="max"
                x-on:input="mintrigger"
                x-model="minprice"
                class="pointer-events-none absolute z-20 h-2 w-full cursor-pointer appearance-none opacity-0"
            />

            <input
                type="range"
                step="10"
                x-bind:min="min"
                x-bind:max="max"
                x-on:input="maxtrigger"
                x-model="maxprice"
                class="pointer-events-none absolute z-20 h-2 w-full cursor-pointer appearance-none opacity-0"
            />

            <div class="relative z-10 h-2">
                <div class="absolute bottom-0 left-0 right-0 top-0 z-10 rounded-md bg-gray-200"></div>

                <div
                    class="absolute bottom-0 top-0 z-20 rounded-md bg-lime-500"
                    x-bind:style="'right:' + maxthumb + '%; left:' + minthumb + '%'"
                ></div>

                <div
                    class="absolute left-0 top-0 z-30 -ml-1 -mt-2 h-6 w-6 rounded-full bg-lime-600"
                    x-bind:style="'left: ' + minthumb + '%'"
                ></div>
                <div
                    class="absolute right-0 top-0 z-30 -mr-3 -mt-2 h-6 w-6 rounded-full bg-lime-600"
                    x-bind:style="'right: ' + maxthumb + '%'"
                ></div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-7">
            <div>
                <input
                    type="text"
                    maxlength="5"
                    x-on:input="mintrigger"
                    x-model="minprice"
                    class="w-24 rounded border border-neutral-300/70 px-3 py-2 text-center"
                />
            </div>
            <div class="text-xl">-</div>
            <div>
                <input
                    type="text"
                    maxlength="5"
                    x-on:input="maxtrigger"
                    x-model="maxprice"
                    class="w-24 rounded border border-neutral-300/70 px-3 py-2 text-center"
                />
            </div>
            {{ $submitButtonSlot }}
        </div>
    </div>
</div>
