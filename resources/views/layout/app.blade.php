<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Link Bootstrap and FontAwesome from Directory -->
    <link rel="stylesheet" href="{{ asset('css/fontAwesome/fontawesome.min.css') }}">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-indigo-900 text-white">
    {{-- Include Header --}}
    @include('includes.header')

    <div class="mt-4 min-h-[70vh] max-w-1200 mx-auto">
        @yield('content')
    </div>


    {{-- Include Footer --}}
    @include('includes.footer')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-migrate.min.js')}}"></script>
</body>
</html>