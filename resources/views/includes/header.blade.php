<header class="bg-indigo-950 border-b">
    <div class="flex uppercase w-full justify-between max-w-1200 mx-auto min-h-32 font-bold">
        <div class="rightCol flex w-1/6 font-mono capitalize text-3xl p-2 text-center items-center">
            <div>Thought Threads</div>
        </div>
        <div class="leftCol navbar w-5/6 flex items-center p-2 justify-center">
            <div class="navItem p-2 px-4 {{ Request::routeIs('home') ? 'border-b' : '' }}"><a href="{{route('home')}}">Home</a></div>
            <div class="navItem p-2 px-4 {{ Request::routeIs('about') ? 'border-b' : '' }}"><a href="{{route('about')}}">About</a></div>
            <div class="navItem p-2 px-4 {{ Request::routeIs('contact') ? 'border-b' : '' }}"><a href="{{route('contact')}}">Contact</a></div>
            <div class="navItem p-2 px-4 {{ Request::routeIs('register') ? 'border-b' : '' }}"><a href="{{route('register')}}">Register</a></div>
            <div class="navItem p-2 px-4 {{ Request::routeIs('Login') ? 'border-b' : '' }}"><a href="{{route('login')}}">Login</a></div>
            <div class="navItem p-2 px-4 {{ Request::routeIs('dashboard') ? 'border-b' : '' }}"><a href="{{route('dashboard')}}">Dashboard</a></div>
        </div>
    </div>
</header>