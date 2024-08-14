<header class="bg-indigo-950 border-b">
    <div class="flex md:flex-row flex-col uppercase w-full justify-between max-w-1200 mx-auto min-h-32 font-bold">
        <div class="rightCol flex xl:w-1/6 font-mono capitalize text-3xl p-2 text-center items-center">
            <div class="w-full">Thought Threads</div>
        </div>
        <div class="leftCol navbar xl:w-5/6 items-center p-2 justify-center hidden md:flex">
            <a href="{{ route('home') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('home') ? 'border-b' : '' }}">Home</div>
            </a>
            <a href="{{ route('about') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('about') ? 'border-b' : '' }}">About</div>
            </a>
            <a href="{{ route('contact') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('contact') ? 'border-b' : '' }}">Contact</div>
            </a>

            @if (Auth::check())
                <!-- Show these items if the user is logged in -->
                <a href="{{ route('dashboard') }}">
                    <div class="navItem p-2 px-4 {{ Request::is('dashboard*') ? 'border-b' : '' }}">Dashboard</div>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="navItem p-2 px-4">Logout</div>
                </a>
            @else
                <!-- Show these items if the user is logged out -->
                <a href="{{ route('register') }}">
                    <div class="navItem p-2 px-4 {{ Request::routeIs('register') ? 'border-b' : '' }}">Register</div>
                </a>
                <a href="{{ route('login') }}">
                    <div class="navItem p-2 px-4 {{ Request::routeIs('login') ? 'border-b' : '' }}">Login</div>
                </a>
            @endif
        </div>

        {{-- Mobile Brekpoint NavBar --}}
        <div class="MobileNav navbar xl:w-5/6 flex flex-col items-center p-2 md:hidden border-t mt-2 !pb-6">
            <a href="{{ route('home') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('home') ? 'border-b' : '' }}">Home</div>
            </a>
            <a href="{{ route('about') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('about') ? 'border-b' : '' }}">About</div>
            </a>
            <a href="{{ route('contact') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('contact') ? 'border-b' : '' }}">Contact</div>
            </a>

            @if (Auth::check())
                <!-- Show these items if the user is logged in -->
                <a href="{{ route('dashboard') }}">
                    <div class="navItem p-2 px-4 {{ Request::is('dashboard*') ? 'border-b' : '' }}">Dashboard</div>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="navItem p-2 px-4">Logout</div>
                </a>
            @else
                <!-- Show these items if the user is logged out -->
                <a href="{{ route('register') }}">
                    <div class="navItem p-2 px-4 {{ Request::routeIs('register') ? 'border-b' : '' }}">Register</div>
                </a>
                <a href="{{ route('login') }}">
                    <div class="navItem p-2 px-4 {{ Request::routeIs('login') ? 'border-b' : '' }}">Login</div>
                </a>
            @endif
        </div>
    </div>
</header>
<x-error-popup :errors="$errors" :successMessage="session('status')"/>