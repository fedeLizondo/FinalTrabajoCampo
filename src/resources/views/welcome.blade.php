<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/leader-line.min.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-position: 0 0 !important;
            height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="m-2">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <div id="app" class="h-100">
        <!-- search-component></search-component -->
        @auth
        <proyecto-component proyecto_id="1" user_id={{ Auth::user()->id }} ></proyecto-component>
        @else
        <proyecto-component proyecto_id="1"></proyecto-component>
        @endauth
        <!--diagrama-clase-componente></diagrama-clase-componente-->
    </div>
    
</body>

</html>