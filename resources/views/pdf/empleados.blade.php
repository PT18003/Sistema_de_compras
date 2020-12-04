                
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        
    </head>
    <body class="font-sans antialiased">
          <h3> Sistema de compras TOO115</h3>
                      <h5> Lista de empleados <b> Actualizada</b></h5>
                      <table class="table table-hover responsive table-sm">
                          <thead>
                              <tr>
                                  <th scope="col" class="d-none" >id</th>
                                  <th scope="col">Nombres</th>
                                  <th scope="col">Apellidos</th>
                                  <th scope="col">Direccion</th>
                                  <th scope="col">Genero</th>
                                  <th scope="col">Telefono</th>
                                  <th scope="col">Area de trabajo</th>
                                  <th scope="col">Usuario</th>
                                
                                  
                                  
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($empleados as $item)
                              <tr>
                                  <th scope="row" id="ver" data-toggle="modal" data-target="#staticBackdrop" class="d-none">{{$item->id}}</th>
                                  <td>{{$item->nombres}}</td>
                                  <td>{{$item->apellidos}}</td>
                                  <td>{{$item->direccion}}, {{$item->municipio->municipio}}, {{$item->municipio->departamentos->departamento}}</td>
                                  <td>{{$item->genero->genero}}</td>
                                  <td>{{$item->telefono}}</td>
                                  <td>{{$item->areatrabajo->nombreDep}}</td>
                                  <td>
                                    @if (is_null($item->user))
                                    
                                    <a href="{{ route('registro',$item->id) }}" class="badge badge-warning">Sin Usuario</a>
                                    @else
                                    <a href="" class="badge badge-success">Con Usuario</a>
                                    @endif

                                  </td>
                                 
                              </tr>
                            
                   
                              @endforeach
                          </tbody>
                      </table>

        
        
        
    </body>
</html>


                    