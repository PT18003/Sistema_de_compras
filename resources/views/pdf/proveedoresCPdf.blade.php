                
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
                    <h1>Ordenes de compra por proveedores</h1>
                    
                    <h3 class="text-center"> Sistema de compras TOO115 </h3>
                </div>
            


                 <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"class=" d-none">id</th>
                            <th scope="col" class="text-center">Proveedor</th>          
                            <th scope="col" class="text-center">Cantidad de articulos</th>
                            <th scope="col" class="text-center">Ordenes de compra </th>
                        </tr>
                    </thead>
             

                     <tbody>
                     @foreach($proveedores as $item)
                       <tr>
                            <td scope="row" class=" d-none">{{$item->id}}</td>
                            <td class="text-center">{{$item->nombre}} </td>
                               <td class="text-center">
                                <?php
                                $monto=0;
                                $suma=0;
                                foreach ($join as $row)
                                {
                                    if($item->id == $row->id)
                                    {
                                        foreach($ordenes as $orden)
                                        {
                                            if($orden->ordenCompra == $row->ordenCompra)
                                            {
                                                $suma = $suma + $orden->cantidad;
                                            }
                                        }
                                        
                                    
                                    }
                                }
                                ?>
                                {{$suma}}
                                
                                    
                                </td>

                            <td >
                              @foreach ($join as $row)
                                @if($item->id == $row->id)
                                
                                    
                                          <h6><b>Monto: </b>
                                       
                                            <?php 
                                            $monto = 0;
                                            $suma = 0; 
                                            $creada = null;
                                            ?>
                                            @foreach($ordenes as $orden)
                                             
                                                @if($orden->ordenCompra == $row->ordenCompra)
                                                    <?php
                                                    $suma = $suma + $orden->cantidad;
                                                
                                                    $monto = $monto + (round((((100-$orden->articuloProveedor['descuento'])/100)*$orden->articuloProveedor['precio'])*($orden->cantidad),4));
                                                    $creada = $orden->created_at;
                                                    ?>
                                                  
                                                 
                                                @endif
                                             
                                            @endforeach
                                            {{$monto}}
                                            </h6>
                                            <h6>
                                            <b>Orden de compra: </b>
                                            {{$row->ordenCompra}}</h6>
                                            <h6><b>Articulos: </b>
                                             {{$suma}}</h6>
                                            <h6><b>Fecha creada: </b>
                                            {{$creada}}</h6>
                                             
                                       
                                      <br>
                                @endif    
                            @endforeach
                  
                            </td>
                       
                        
                      
                        </tr>
                      @endforeach
                    </tbody>
                </table>   
    </body>
</html>


                    