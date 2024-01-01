<div class="navbar container bg-base-100 py-8">
    <div class="navbar-start">
        <a class="btn btn-ghost text-2xl">YOURBRAND.COM</a>
    </div>
    <div class="navbar-center space-x-8">
        <div class="btn btn-md rounded-none">Product catalogue</div>
        <div class="join ">
            <div>
                <div>
                    <input class="w-[700px] input input-bordered join-item rounded-none"
                           placeholder="Search" />
                </div>
            </div>
            <div class="indicator">
                <button class="btn join-item rounded-none">Search</button>
            </div>
        </div>
    </div>
    <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <div class="indicator">
                    @svg('gmdi-shopping-cart', 'h-6 w-6')
                    <span class="badge badge-sm indicator-item">8</span>
                </div>
            </div>
            <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                <div class="card-body">
                    <span class="font-bold text-lg">8 Items</span>
                    <span class="text-info">Subtotal: $999</span>
                    <div class="card-actions">
                        <button class="btn btn-primary btn-block">View cart</button>
                    </div>
                </div>
            </div>
        </div>
        @auth()
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        @svg('gmdi-logo-dev-o')
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a class="justify-between">
                            Profile
                            <span class="badge">New</span>
                        </a>
                    </li>
                    <li><a>Settings</a></li>
                    <li>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <span><a class="link ml-5" href="/login">Login</a></span>
            <span class="mx-2">or</span>
            <span><a class="link" href="/register">Register</a></span>
        @endauth
    </div>
</div>
