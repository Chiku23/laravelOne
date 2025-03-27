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
</head>
<body class="bg-foreground text-white flex flex-col min-h-screen">
    {{-- Include Header --}}
    @include('includes.header')

    <div class="flex flex-grow max-w-1200 mx-auto w-full">
        @yield('content')
    </div>

    {{-- Include Footer --}}
    @include('includes.footer')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate.min.js')}}"></script>
    {{-- Include Custom Js Scripts --}}
    <script src="{{asset('js/customScripts/user-frontend.js')}}"></script>
</body>
</html>