<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        {{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> Sirve para la paginacion, para darle estilo--}}    
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/style.css">
        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>@yield('title')</title>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <a class="navbar-brand" href="{{route('index')}}">Sistema De Compras</a>
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="{{route('departamentos.index')}}">Departamentos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('municipios.index')}}">Municipios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('areatrabajos.index')}}">Areas de Trabajo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('generos.index')}}">Genero</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('estadosciviles.index')}}">Estados Civiles</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('estadosciviles.index')}}">Empleados</a>
                </li>
              </ul>
            </div>
          </nav>
    

        @stack('modals')

        @livewireScripts
        @yield('content')
        <script src="/js/jquery-3.5.1.slim.min.js" ></script>
        <script src="/js/popper.min.js" ></script>
        <script src="/js/script.js" ></script>
        <script src="/js/bootstrap.min.js" ></script>
    </body>
</html>
