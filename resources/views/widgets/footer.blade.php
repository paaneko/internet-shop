<footer class="mt-28">
    <div class="bg-lime-500">
        <div class="container p-10 flex justify-between items-center separator">
            <div class="text-4xl text-white font-semibold">YOURBRAND.COM</div>
            <div class="border border-white h-12"></div>
            <div class="flex justify-between items-center">
                <div class="max-w-[250px] text-white font-medium mr-10">Subscribe to our newsletter and get special
                    offers
                </div>
                <form method="post" action="/newsletters">
                    @csrf
                    <div class="join space-x-2">
                        <div>
                            <div>
                                <input name="email"
                                       class="w-[500px] input input-bordered join-item rounded-none"
                                       placeholder="Enter your email" />
                                @error('email')
                                <div class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="indicator">
                            <button type="submit"
                                    class="btn join-item rounded-none bg-lime-500 text-white border-2 hover:bg-lime-600"
                            >Subscribe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-base-200">
        <div class="p-10 container footer text-base-content">
            <aside>
                @svg('gmdi-filter-hdr-r', 'h-20 w-20')
                <p>YOURBRAND.COM<br />Providing reliable tech since 1992</p>
            </aside>
            <nav>
                <header class="footer-title">Services</header>
                <a class="link link-hover">Branding</a>
                <a class="link link-hover">Design</a>
                <a class="link link-hover">Marketing</a>
                <a class="link link-hover">Advertisement</a>
            </nav>
            <nav>
                <header class="footer-title">Company</header>
                <a class="link link-hover">About us</a>
                <a class="link link-hover">Contact</a>
                <a class="link link-hover">Jobs</a>
                <a class="link link-hover">Press kit</a>
            </nav>
            <nav>
                <header class="footer-title">Legal</header>
                <a class="link link-hover">Terms of use</a>
                <a class="link link-hover">Privacy policy</a>
                <a class="link link-hover">Cookie policy</a>
            </nav>
        </div>
    </div>
</footer>
