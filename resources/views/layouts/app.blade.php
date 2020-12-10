<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        <link rel="icon" href="{{ asset('laptop.ico') }}"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        {{--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">--}}
        

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        @livewireStyles

        
    </head>
    <body class="font-sans antialiased">
        
            @livewire('navigation-dropdown')
       
        @stack('modals')
        
        @yield('content')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js"></script>
        <script src="{{ asset('js/jquery-3.5.1.slim.min.js')}}" ></script>
        <script src="{{ asset('js/popper.min.js')}}" ></script>
        <script src="{{ asset('js/script.js')}}" ></script>
        <script src="{{ asset('js/bootstrap.min.js')}}" ></script>
    </body>
</html>
