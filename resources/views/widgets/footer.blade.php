<footer class="mt-28">
    <div class="bg-lime-500">
        <div class="separator container flex items-center justify-between p-10">
            <div class="text-4xl font-semibold text-white">YOURBRAND.COM</div>
            <div class="h-12 border border-white"></div>
            <div class="flex items-center justify-between">
                <div class="mr-10 max-w-[250px] font-medium text-white">
                    Subscribe to our newsletter and get special offers
                </div>
                <form method="post" action="/newsletters">
                    @csrf
                    <div class="join space-x-2">
                        <div>
                            <div>
                                <input
                                    name="email"
                                    class="input join-item input-bordered w-[500px] rounded-none"
                                    placeholder="Enter your email"
                                />
                                @error('email')
                                    <div class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="indicator">
                            <button
                                type="submit"
                                class="btn join-item rounded-none border-2 bg-lime-500 text-white hover:bg-lime-600"
                            >
                                Subscribe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-base-200">
        <div class="container footer p-10 text-base-content">
            <aside>
                @svg('gmdi-filter-hdr-r', 'h-20 w-20')
                <p>
                    YOURBRAND.COM
                    <br />
                    Providing reliable tech since 1992
                </p>
            </aside>
            <nav>
                <header class="footer-title">Services</header>
                <a class="link-hover link">Branding</a>
                <a class="link-hover link">Design</a>
                <a class="link-hover link">Marketing</a>
                <a class="link-hover link">Advertisement</a>
            </nav>
            <nav>
                <header class="footer-title">Company</header>
                <a class="link-hover link">About us</a>
                <a class="link-hover link">Contact</a>
                <a class="link-hover link">Jobs</a>
                <a class="link-hover link">Press kit</a>
            </nav>
            <nav>
                <header class="footer-title">Legal</header>
                <a class="link-hover link">Terms of use</a>
                <a class="link-hover link">Privacy policy</a>
                <a class="link-hover link">Cookie policy</a>
            </nav>
        </div>
    </div>
</footer>
