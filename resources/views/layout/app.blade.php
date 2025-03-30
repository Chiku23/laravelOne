<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    {{-- @vite('resources/css/app.css') --}}
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
    <title>{{config('app.name')}}</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-foreground text-white flex flex-col min-h-screen">
    {{-- Include Header --}}
    @if(!Request::routeIs('login') && !Request::routeIs('register'))
        @include('includes.header')
    @endif

    @if(!Request::routeIs('login') && !Request::routeIs('register'))
        <div class="flex flex-grow max-w-1200 mx-auto w-full">
    @else
        <div class="flex flex-col max-w-1200 mx-auto w-full h-dvh">
    @endif
        @yield('content')
    </div>

    {{-- Include Footer --}}
    @if(!Request::routeIs('login') && !Request::routeIs('register'))
        @include('includes.footer')
    @endif

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate.min.js')}}"></script>
    {{-- Include Custom Js Scripts --}}
    <script src="{{asset('js/customScripts/user-frontend.js')}}"></script>

    <script src="{{ asset('build/assets/app2.js') }}"></script>
    @stack('scripts')
</body>
</html>