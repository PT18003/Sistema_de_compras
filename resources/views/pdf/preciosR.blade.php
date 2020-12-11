                
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
    <body class="">
  
                <div class="branding">
                    <h1>Precios vigentes al: <b><?php
                    	
                   echo date("d/m/Y");
                    ?>
                    </b></h1>
              
                </div>
                   <h3 href=""> Sistema de compras TOO115</h3>
    
                    <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"class=" d-none">id</th>
                            <th scope="col" class="text-center">Proveedor</th>
                           
                            <th scope="col" class="text-center">Ariculo</th>
                            <th scope="col" class="text-center">Detalles</th>
                        </tr>
                    </thead>
             

                     <tbody>
                     @foreach($proveedores as $item)
                       
                          
                      
                            @foreach ($precios as $row)
                                @if($item->id == $row->id_proveedor)
                                 <tr>
                                   <td scope="row" class=" d-none">{{$item->id}}</td>
                                   <td class="text-center">{{$item->nombre}} </td>
                                   
                                <td>
                                    <h6>
                                        
                                        {{$row->Ncatalogo}}
                                        
                                        
                                    </h6>
                                </td>
                                <td>
                                     <h6>
                                             <span class="badge badge-success"><b>Fecha Inicio: </b></span> {{$row->fechaInicio}}
                                             <span class="badge badge-danger"><b>Fecha Final: </b></span> {{$row->fechaFinal}}
                                            <b>Precio Unitario: </b> {{$row->precio}}
                                            <b>Descuento: </b> {{$row->descuento}}<b>%</b>
                                    
                                        </h6>
                                </td>
                                 </tr>
                                @endif
                            @endforeach              
                       
                      @endforeach
                    </tbody>
                </table>   
               
         
            
        </body>
</html>


                    