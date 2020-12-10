
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        
    </head>
    <body class="">

            <div class="card-body ">                  
                <div class="branding">
                    <h1>Reporte de articulos ordenados por empleado</h1>
                         <h3 class="text-center"> Sistema de compras TOO115 </h3>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"class=" d-none">id</th>
                            <th scope="col" class="text-center">Empleado</th>
                           
                            <th scope="col" class="text-center">Cantidad de articulos</th>
                            <th scope="col" class="text-center">Requisiciones </th>
                        </tr>
                    </thead>
             

                     <tbody>
                        @foreach ($suma as $item)
                        <tr>
                            <th scope="row" class=" d-none">{{$item->id}}</th>
                            <td class="text-center">{{$item->nombres}} {{$item->apellidos}}</td>
                            <td class="text-center">{{$item->total}}</td>
                            <td>
                            @foreach($empleados as $elemento)
                               
                                @if($elemento->id == $item->id)
                               
                                    @foreach($elemento->requisicionesEmpleado as $requi)
                                    <div class="card">
                                        <div class="card-body mt-2 mb-2 card-block">
                                            
                                            <?php 
                                            $sumar = 0;                                        
                                            foreach($requi->articuloProveedor as $detalle)
                                            $sumar= $sumar+ $detalle->cantidad
                                            ?> 
                                            <b>Articulos: </b>{{$sumar}}
                                            <b>Creada: </b>{{$requi->created_at}}
                                            
                                            @if($requi->estado_req==1)
                                           
                                            <span class="badge bg-info text-light"> Enviada</span>
                                           
                                            @else
                                           <span class="badge bg-secondary text-light">No Enviada</span>
                                            @endif
                                            @if($requi->aceptado_id!=null)
                                            {
                                                {{$requi->aceptado_id}}
                                                {{$requi->fechaAceptada}}
                                            }
                                        
                                            @endif
                                           
                                           
                                        </div>
                                    </div>

                                    @endforeach
                                     
                                    
                                @endif
                              
                            @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
    

            </div>
                      
    </body>
</html>


                    