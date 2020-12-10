

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        
    </head>
    <body class="">


           
                        <div class=" card-body ">                  
                            <div class="branding">
                                <h1>Reporte de articulos ordenados por Areas de Trabajo</h1>
                                  <h3 class="text-center"> Sistema de compras TOO115 </h3>
                             
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col"class=" d-none">id</th>
                                        <th scope="col" class="text-center">Area</th>
                                    
                                        <th scope="col" class="text-center">Cantidad de articulos</th>
                                        <th scope="col" class="text-center">Requisiciones </th>
                                    </tr>
                                </thead>
                        

                                <tbody>
                                    @foreach ($suma as $item)
                                    <tr>
                                        <th scope="row" class=" d-none">{{$item->areatrabajo_id}}</th>
                                        <td class="text-center">{{$item->nombreDep}} </td>
                                        <td class="text-center">{{$item->total}}</td>
                                        <td>
                                        @foreach($requisiciones as $elemento)
                                        
                                        
                                        @if($elemento->creado->areatrabajo_id == $item->areatrabajo_id)
                                            
                                                <div class="card mt-2 mb-2 card-block">
                                                    <div class="card-body">
                                                
                                                        <?php 
                                                        $sumar = 0;                                        
                                                        foreach($elemento->articuloProveedor as $detalle)
                                                        $sumar= $sumar+ $detalle->cantidad
                                                        ?> 
                                                        <b>Articulos: </b>{{$sumar}}

                                                        <b>Creada: </b>{{$elemento->created_at}}

                                                        @if($elemento->estado_req==1)
                                                    
                                                        <span class="badge bg-info text-light"> Enviada</span>
                                                      
                                                        @else
                                                    <span class="badge bg-secondary text-light">No Enviada</span>
                                                        @endif
                                                        @if($elemento->aceptado_id!=null)
                                                        {
                                                            {{$elemento->aceptado_id}}
                                                            {{$elemento->fechaAceptada}}
                                                        }
                                                    
                                                        @endif
                                                        
                                                        
                                                    
                                                    
                                                    </div>
                                                </div>
                                            
                                            
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


                    