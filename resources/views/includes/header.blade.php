@php
    $avatar = null;
    if(session('user')){
        $user = session('user');
        $avatar = $user['avatar'] ?? null;
    }
    $userImage = $avatar ?? asset('images/person.png');
@endphp



<header class="sticky top-0 z-40 w-full bg-white/80 dark:bg-slate-950/70 backdrop-blur-md border-b border-slate-200 dark:border-slate-800/80 transition-colors duration-250">
    <div class="flex md:flex-row flex-col w-full sm:justify-between max-w-1200 mx-auto px-4 sm:px-6 lg:px-8 py-4 font-bold items-center">
        <!-- Brand Logo/Title -->
        <div class="flex xl:w-1/4 font-sans text-2xl p-2 items-center justify-between w-full md:w-auto">
            <a href="{{ route('home') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 font-extrabold tracking-tight hover:opacity-90 transition-opacity">
                Thought Threads
            </a>
            <div class="flex items-center gap-3 md:hidden">
                {{-- Mobile Breakpoint Hamburger --}}
                <div class="Hamburger text-2xl cursor-pointer flex items-center justify-center p-2 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white transition-colors">
                    <div class="mobileMenu menuClose"><i class="fa-solid fa-bars"></i></div>
                    <div class="mobileMenu menuOpen hidden"><i class="fa-solid fa-xmark"></i></div>
                </div>
            </div>
        </div>

        <!-- Desktop Nav Items -->
        <div class="leftCol navbar xl:w-5/6 items-center p-2 justify-center gap-2 hidden md:flex">
            <a href="{{ route('home') }}" class="group">
                <div class="navItem px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all {{ Request::routeIs('home') ? 'bg-slate-100 dark:bg-slate-800/80 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700/50' : 'hover:bg-slate-100/50 dark:hover:bg-slate-900/50' }}">
                    <i class="fa-solid fa-house mr-1 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"></i> Home
                </div>
            </a>
            <a href="{{ route('about') }}" class="group">
                <div class="navItem px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all {{ Request::routeIs('about') ? 'bg-slate-100 dark:bg-slate-800/80 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700/50' : 'hover:bg-slate-100/50 dark:hover:bg-slate-900/50' }}">
                    <i class="fa-solid fa-address-card mr-1 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"></i> About
                </div>
            </a>
            <a href="{{ route('contact') }}" class="group">
                <div class="navItem px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all {{ Request::routeIs('contact') ? 'bg-slate-100 dark:bg-slate-800/80 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700/50' : 'hover:bg-slate-100/50 dark:hover:bg-slate-900/50' }}">
                    <i class="fa-solid fa-address-book mr-1 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"></i> Contact
                </div>
            </a>

            @if (Auth::check())
                <a href="{{ route('dashboard') }}" class="group">
                    <div class="navItem px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all {{ Request::is('dashboard*') ? 'bg-slate-100 dark:bg-slate-800/80 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700/50' : 'hover:bg-slate-100/50 dark:hover:bg-slate-900/50' }}">
                        <i class="fa-solid fa-clapperboard mr-1 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"></i> Dashboard
                    </div>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="group">
                    <div class="navItem px-4 py-2 rounded-xl text-red-500 dark:text-red-400 hover:text-red-650 dark:hover:text-red-300 hover:bg-red-500/10 border border-transparent hover:border-red-500/20 transition-all">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
                    </div>
                </a>
            @else
                <a href="{{ route('register') }}" class="group">
                    <div class="navItem px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all {{ Request::routeIs('register') ? 'bg-slate-100 dark:bg-slate-800/80 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700/50' : 'hover:bg-slate-100/50 dark:hover:bg-slate-900/50' }}">
                        <i class="fa-solid fa-user-plus mr-1 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"></i> Register
                    </div>
                </a>
                <a href="{{ route('login') }}" class="group">
                    <div class="navItem px-4 py-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all {{ Request::routeIs('login') ? 'bg-slate-100 dark:bg-slate-800/80 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700/50' : 'hover:bg-slate-100/50 dark:hover:bg-slate-900/50' }}">
                        <i class="fa-solid fa-right-to-bracket mr-1 text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 transition-colors"></i> Login
                    </div>
                </a>
            @endif

        </div>

        <!-- Mobile Nav Items -->
        <div class="MobileNav w-full flex flex-col items-stretch md:hidden transition-all duration-300 ease-in-out max-h-0 opacity-0 overflow-hidden mt-4 gap-2 border-t border-slate-200 dark:border-slate-800/60 pt-4">
            <a href="{{ route('home') }}">
                <div class="navItem px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900 {{ Request::routeIs('home') ? 'bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white border-l-4 border-indigo-500 font-bold' : '' }}">Home</div>
            </a>
            <a href="{{ route('about') }}">
                <div class="navItem px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900 {{ Request::routeIs('about') ? 'bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white border-l-4 border-indigo-500 font-bold' : '' }}">About</div>
            </a>
            <a href="{{ route('contact') }}">
                <div class="navItem px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900 {{ Request::routeIs('contact') ? 'bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white border-l-4 border-indigo-500 font-bold' : '' }}">Contact</div>
            </a>

            @if (Auth::check())
                <a href="{{ route('dashboard') }}">
                    <div class="navItem px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900 {{ Request::is('dashboard*') ? 'bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white border-l-4 border-indigo-500 font-bold' : '' }}">Dashboard</div>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="navItem px-4 py-2 rounded-lg text-red-500 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-950/20 font-bold">Logout</div>
                </a>
            @else
                <a href="{{ route('register') }}">
                    <div class="navItem px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900 {{ Request::routeIs('register') ? 'bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white border-l-4 border-indigo-500 font-bold' : '' }}">Register</div>
                </a>
                <a href="{{ route('login') }}">
                    <div class="navItem px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-900 {{ Request::routeIs('login') ? 'bg-slate-100 dark:bg-slate-900 text-slate-900 dark:text-white border-l-4 border-indigo-500 font-bold' : '' }}">Login</div>
                </a>
            @endif
        </div>

        <!-- User Logo Badges -->
        @if (Auth::check())
            <div class="UserLogo hidden md:flex items-center gap-3 bg-slate-100 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800/80 py-1.5 px-3 rounded-full shadow-sm dark:shadow-inner select-none ml-2">
                <div class="userImage h-8 w-8 rounded-full overflow-hidden border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-850">
                    <img src="{{$userImage}}" alt="user-logo" class="object-cover w-full h-full">
                </div>
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-300 capitalize pr-1">{{$user['name'] ?? ''}}</p>
            </div>
        @endif
    </div>
</header>

{{-- Toast popups --}}
@if (!Request::routeIs('register'))
    <x-error-popup :errors="$errors" :successMessage="session('status')"/>
@endif
