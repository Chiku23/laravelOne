<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    {{-- @vite('resources/css/app.css') --}}
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <title>{{config('app.name')}}</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-slate-50 dark:bg-gradient-to-br dark:from-slate-950 dark:via-slate-900 dark:to-indigo-950 text-slate-800 dark:text-slate-100 flex flex-col min-h-screen antialiased selection:bg-indigo-500 selection:text-white transition-colors duration-250">
    {{-- Include Header --}}
    @if(!Request::routeIs('login') && !Request::routeIs('register') && !Request::is('dashboard*'))
        @include('includes.header')
    @endif

    @if(Request::is('dashboard*'))
        <div class="flex flex-col w-full min-h-screen bg-[#f0f2f5] dark:bg-[#0c0d10]">
    @elseif(!Request::routeIs('login') && !Request::routeIs('register'))
        <div class="flex flex-grow max-w-1200 mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
    @else
        <div class="flex flex-col max-w-1200 mx-auto w-full h-dvh px-4 sm:px-6">
    @endif
        @yield('content')
    </div>

    {{-- Include Footer --}}
    @if(!Request::routeIs('login') && !Request::routeIs('register') && !Request::is('dashboard*'))
        @include('includes.footer')
    @endif

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate.min.js')}}"></script>
    {{-- Include Custom Js Scripts --}}
    @vite('resources/js/app.js')
    @vite('resources/js/frontendscript.js')
    @stack('scripts')
</body>
</html>