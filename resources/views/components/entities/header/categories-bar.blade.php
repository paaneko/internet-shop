@php
    use App\Models\Category;

    $parentCategories = Category::where('parent_id', null)
        ->with('subCategories')
        ->get();
@endphp

<nav
    x-data="{
        navigationMenuOpen: false,
        navigationMenu: '',
        navigationMenuCloseDelay: 200,
        navigationMenuCloseTimeout: null,
        navigationMenuLeave() {
            let that = this
            this.navigationMenuCloseTimeout = setTimeout(() => {
                that.navigationMenuClose()
            }, this.navigationMenuCloseDelay)
        },
        navigationMenuReposition(navElement) {
            this.navigationMenuClearCloseTimeout()
            this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px'
            this.$refs.navigationDropdown.style.marginLeft =
                navElement.offsetWidth / 2 + 'px'
        },
        navigationMenuClearCloseTimeout() {
            clearTimeout(this.navigationMenuCloseTimeout)
        },
        navigationMenuClose() {
            this.navigationMenuOpen = false
            this.navigationMenu = ''
        },
    }"
    class="relative z-10 w-auto"
>
    <div class="relative">
        <ul class="group flex flex-1 list-none items-center justify-start space-x-1 p-1 text-neutral-700">
            @foreach ($parentCategories as $parentCategory)
                <li>
                    <a
                        href="{{ route('category-filter', ['category' => $parentCategory->slug]) }}"
                        :class="{ 'bg-lime-100/70' : navigationMenu=='{{ $parentCategory->slug }}', 'hover:bg-neutral-100' : navigationMenu!='{{ $parentCategory->slug }}' }"
                        @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='{{ $parentCategory->slug }}'"
                        @mouseleave="navigationMenuLeave()"
                        class="group inline-flex h-10 w-max items-center justify-center rounded-md px-4 py-2 text-sm font-semibold transition-colors hover:text-lime-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                    >
                        <span>{{ $parentCategory->name }}</span>
                        <svg
                            :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == '{{ $parentCategory->slug }}' }"
                            class="relative top-[1px] ml-1 h-4 w-4 duration-300 ease-out"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div
        x-ref="navigationDropdown"
        x-show="navigationMenuOpen"
        x-transition:enter="transition duration-100 ease-out"
        x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100"
        x-transition:leave="transition duration-100 ease-in"
        x-transition:leave-start="scale-100 opacity-100"
        x-transition:leave-end="scale-90 opacity-0"
        @mouseover="navigationMenuClearCloseTimeout()"
        @mouseleave="navigationMenuLeave()"
        class="absolute top-0 -translate-x-1/2 translate-y-11 pt-3 duration-200 ease-out"
        x-cloak
    >
        <div
            class="flex h-auto w-auto justify-center overflow-hidden rounded-md border border-neutral-200/70 bg-white shadow-sm"
        >
            @foreach ($parentCategories as $parentCategory)
                <div
                    x-show="navigationMenu == '{{ $parentCategory->slug }}'"
                    class="flex w-full max-w-2xl items-stretch justify-center gap-x-3 p-6"
                >
                    <ul>
                        @foreach ($parentCategory->subCategories as $subCategory)
                            <li>
                                <a
                                    href="{{ route('category-filter', ['category' => $subCategory->slug]) }}"
                                    class="cursor-pointer text-sm font-semibold hover:text-lime-600 hover:underline"
                                >
                                    {{ $subCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</nav>
