@php
    $avatar = null;
    if(session('user')){
        $user = session('user');
        $avatar = $user['avatar'] ?? null;
    }
    $userImage = $avatar ?? asset('images/person.png');
@endphp

<header class="bg-background border-b">
    <div class="flex md:flex-row flex-col uppercase w-full sm:justify-between max-w-1200 mx-auto sm:min-h-32 font-bold">
        <div class="rightCol flex xl:w-1/6 font-mono capitalize text-3xl p-2 text-center items-center">
            <div class="w-full">Thought Threads</div>
        </div>
        <div class="leftCol navbar xl:w-5/6 items-center p-2 justify-center hidden sm:flex">
            <a href="{{ route('home') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('home') ? 'border-white' : '' }} border-b-2 hover:border-white border-transparent"><i class="fa-solid fa-house hidden lg:inline-block"></i> Home</div>
            </a>
            <a href="{{ route('about') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('about') ? 'border-white' : '' }} border-b-2 hover:border-white border-transparent"><i class="fa-solid fa-address-card hidden lg:inline-block"></i> About</div>
            </a>
            <a href="{{ route('contact') }}">
                <div class="navItem p-2 px-4 {{ Request::routeIs('contact') ? 'border-white' : '' }} border-b-2 hover:border-white border-transparent"><i class="fa-solid fa-address-book hidden lg:inline-block"></i> Contact</div>
            </a>

            @if (Auth::check())
                <!-- Show these items if the user is logged in -->
                <a href="{{ route('dashboard') }}">
                    <div class="navItem p-2 px-4 {{ Request::is('dashboard*') ? 'border-white' : '' }} border-b-2 hover:border-white border-transparent"><i class="fa-solid fa-clapperboard hidden lg:inline-block"></i> Dashboard</div>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="navItem p-2 px-4 border-transparent hover:border-red-500 border-b-2"><i class="fa-solid fa-right-from-bracket hidden lg:inline-block"></i> Logout</div>
                </a>
            @else
                <!-- Show these items if the user is logged out -->
                <a href="{{ route('register') }}">
                    <div class="navItem p-2 px-4 {{ Request::routeIs('register') ? 'border-white' : '' }} border-b-2 hover:border-white border-transparent"><i class="fa-solid fa-user-plus hidden lg:inline-block"></i> Register</div>
                </a>
                <a href="{{ route('login') }}">
                    <div class="navItem p-2 px-4 {{ Request::routeIs('login') ? 'border-white' : '' }} border-b-2 hover:border-white border-transparent"><i class="fa-solid fa-right-to-bracket hidden lg:inline-block"></i> Login</div>
                </a>
            @endif
        </div>

        {{-- Mobile Brekpoint NavBar --}}
        <div class="Hamburger text-3xl justify-center flex mb-2 sm:hidden">
            <div class="mobileMenu menuClose cursor-pointer"><i class="fa-solid fa-bars"></i></div>
            <div class="mobileMenu menuOpen cursor-pointer hidden"><i class="fa-solid fa-xmark"></i></div>
        </div>
        <div class="MobileNav navbar xl:w-5/6 flex flex-col items-center md:hidden transition-all duration-300 ease-in-out max-h-0 opacity-0 overflow-hidden">
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
        <div class="UserLogo flex flex-wrap items-center justify-center hidden md:flex p-4">
            <div class="userImage h-10 w-10 text-center">
                <img src="{{$userImage}}" alt="user-logo">
            </div>
            <p class="text-sm capitalize">{{$user['name'] ?? ''}}</p>
        </div>
    </div>
</header>
{{-- Do not show the Error Pop Up in the Register Page. --}}
@if (!Request::routeIs('register'))
    <x-error-popup :errors="$errors" :successMessage="session('status')"/>
@endif
