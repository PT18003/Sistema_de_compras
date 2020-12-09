<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/trick.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Architects+Daughter|Roboto&subset=latin,devanagari">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
     <body class="welcome">
       
     
            <span id="splash-overlay" class="splash"></span>
            <span id="welcome" class="z-depth-4"></span>
            
            <header class="navbar-fixed"> 
                <nav class=" grey lighten-2">
                    <div class="col s12">
                        <ul class="right">
                    
                    
                        @if (Route::has('login'))
                
                            @auth
                            <li class="right">
                                <a href="{{ url('/dashboard') }}" class="text-sm black-text text-black-700 underline">Dashboard</a>
                            </li>
                            @else
                                <li class="right">
                                <a href="{{ route('login') }}" class="text-sm black-text text-black-700 underline">Logearse</a>
                                    </li>
                                @if (Route::has('register'))
                                        <li class="right">
                                    <a href="{{ route('register') }}" class="ml-4 black-text text-sm text-black-700 underline">Registrarse</a>
                                        </li>
                                @endif
                            @endif
                
                        @endif
                        </ul>
                    </div>
                </nav>
            </header>

            <main class="valign-wrapper">
                <span class="container black-text text-lighten-1 ">

                <p class="flow-text">Bienvenido</p>
                <h1 class="black-text text-lighten-3">Sistema de compras TOO115</h1>

                <blockquote class="flow-text">Por LuxeDevelopment</blockquote>

                <div class="center-align">
                    <!-- Dropdown Trigger -->
                      @if (Route::has('login'))
               
                            @auth
                          
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary  blue darken-4">Dashboard</a>
                          
                            @else
                            
                                <a href="{{ route('login') }}" class="btn btn-primary  blue darken-4">Logearse</a>
                                
                                @if (Route::has('register'))
                                 
                                    <a href="{{ route('register') }}" class="btn btn-primary  blue darken-4">Registrarse</a>
                                  
                                @endif
                            @endif
                    
                    @endif
                   
                  
                </div>

                </span>
            </main>

         

       
            
            <footer class="page-footer grey lighten-3">
                <div class="footer-copyright grey lighten-2">
                <div class="container black-text">
                    <time datetime="">&copy; 2020 LuxeDevelopment</time>
                </div>
                </div>
            </footer>
            

    </body>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</html>
