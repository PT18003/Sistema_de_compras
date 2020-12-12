

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
                                            
                                                <div class="card">
                                                
                                                
                                                        <?php 
                                                        $sumar = 0;                                        
                                                        foreach($elemento->articuloProveedor as $detalle)
                                                        $sumar= $sumar+ $detalle->cantidad
                                                        
                                                        ?>
                                                        <p> 
                                                        <b>Articulos: </b>{{$sumar}}

                                                        <b>Creada: </b>
                                                            <?php
                                                                $date_now = $elemento->created_at;
                                                                $date_future = strtotime($date_now);
                                                                $date_future = date('d-m-Y', $date_future);
                                                                echo $date_future;
                                                            ?>
                                                            <br>
                                                     

                                                            @if($elemento->estado_req==0)
                                                            <span class="badge bg-secondary text-light">No Enviada</span>

                                                            @else
                                                        
                                                            <span class="badge bg-info text-light"> Enviada</span>
                                                            @if($elemento->aceptado_id!=null)
                                                                    <span class="badge bg-primary text-light">Aceptada   
                                                                    
                                                                        <?php
                                                                            $date_now = $elemento->fechaAceptada;
                                                                            $date_future = strtotime($date_now);
                                                                            $date_future = date('d-m-Y', $date_future);
                                                                            echo $date_future;
                                                                        ?>
                                                                        </span>
                      
                                                                
                                                                @else
                                                                    <span class="badge bg-danger text-light">No Aceptada</span>
                                                                @endif
                                                            @endif
                                                            </p>
                                                        
                                                        
                                                    
                                                    
                                                
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


                    