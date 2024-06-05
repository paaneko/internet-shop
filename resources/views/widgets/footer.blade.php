<footer class="mt-5 bg-white">
    <div class="bg-lime-500">
        <div class="separator container flex items-center justify-between p-10">
            <div class="text-4xl font-semibold text-white">LIMETECH.COM</div>
            <div class="h-12 border border-white"></div>
            <div class="flex items-center justify-between">
                <div class="mr-10 max-w-[250px] font-medium text-white">
                    Subscribe to our newsletter and get special offers
                </div>
                <form class="f" method="post" action="/newsletters">
                    @csrf
                    <div class="flex flex-row space-x-2">
                        <div>
                            <div class="">
                                <input
                                    name="email"
                                    placeholder="Enter your email"
                                    class="ring-offset-background flex h-10 w-[500px] rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-500"
                                />
                                @error('email')
                                    <div class="absolute">
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container w-full">
        <div class="grid grid-cols-2 gap-8 py-6 md:grid-cols-5">
            <div class="space-y-6">
                <a href="/" class="btn btn-ghost flex items-center space-x-1 text-2xl">
                    @svg('icon-lime', 'h-[46px] w-[46px]')
                    <div>
                        <span class="leading-none">
                            <span class="text-3xl font-semibold leading-none text-lime-700">LimeTech</span>
                        </span>
                        <div class="flex text-xs font-medium text-lime-600">Where Tech Meets Fresh</div>
                    </div>
                </a>
                <div class="space-y-2">
                    <div class="flex flex-col">
                        <p class="text-xl font-bold text-gray-800">(123) 456-7890</p>
                        <span class="text-sm font-medium">Make an order</span>
                        <span class="text-sm font-medium">9:00 - 21:00</span>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold text-gray-800">(987) 654-3210</p>
                        <span class="text-sm font-medium">Support service</span>
                        <span class="text-sm font-medium">9:00 - 19:00</span>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">Company</h2>
                <ul class="font-medium text-gray-500">
                    <li class="mb-4">
                        <a href="#" class="hover:underline">About</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Careers</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Brand Center</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Blog</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">Help center</h2>
                <ul class="font-medium text-gray-500">
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Discord Server</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Twitter</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Facebook</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">Legal</h2>
                <ul class="font-medium text-gray-500">
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Privacy Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Licensing</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold uppercase text-gray-900">Download</h2>
                <ul class="font-medium text-gray-500">
                    <li class="mb-4">
                        <a href="#" class="hover:underline">iOS</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Android</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">Windows</a>
                    </li>
                    <li class="mb-4">
                        <a href="#" class="hover:underline">MacOS</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-lime-200/70">
        <div class="container py-6 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">
                © 2023
                <a href="https://flowbite.com/">Flowbite™</a>
                . All Rights Reserved.
            </span>
            <div class="mt-4 flex space-x-5 sm:justify-center md:mt-0">
                <a href="{{ config('app.app_gitlab_url') }}" class="text-gray-400 hover:text-gray-900">
                    @svg('fontisto-gitlab', 'h-5 w-5')
                    <span class="sr-only">GitLab Source Code</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-900">
                    @svg('fontisto-discord', 'h-5 w-5')
                    <span class="sr-only">Discord community</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-900">
                    @svg('fontisto-twitter', 'h-5 w-5')
                    <span class="sr-only">Twitter page</span>
                </a>
                <a href="{{ config('app.app_github_url') }}" class="text-gray-400 hover:text-gray-900">
                    @svg('fontisto-github', 'h-5 w-5')
                    <span class="sr-only">GitHub Source Code</span>
                </a>
            </div>
        </div>
    </div>
</footer>
