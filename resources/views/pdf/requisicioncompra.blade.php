                
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        
    </head>
    <body class="font-sans antialiased">
          <h3 class="text-center"><b> Sistema de compras TOO115 S.A</b></h3>
          <h5 class="text-center"> Ruc. 129391-9283</h5>
         <h5 class="text-center">
           <a> Requisición de compra</a> 
           No: <b> {{$requisicion->id}}</b>
        </h5>
            <h6 class="text-center">Departamento que solicita: <b>{{$requisicion->creado->areatrabajo->nombreDep}}</b></h6>
            
                    <p>
                    <h6 class="text-center">Fecha de pedido: <b>
                    <?php
                        $date_now = $requisicion->created_at;
                        $date_future = strtotime($date_now);
                        $date_future = date('d-m-Y', $date_future);
                        echo $date_future;
                    ?>
                    </b>
       
                   Fecha de entrega: <b>
                    <?php
                        $date_now = $requisicion->created_at;
                        $date_future = strtotime('+30 day', strtotime($date_now));
                        $date_future = date('d-m-Y', $date_future);
                        echo $date_future;
                    ?>
                    </b></h6>
                    </p>
                
                   <div class="container">
                        <p class="">Detalles de la requisicion</p>
                      <table class="table table-sm  table-bordered">
                        
                          <thead>
                              <tr>
                              
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Unidad</th>
                                    <th scope="col">Articulo</th>
                                  
                                  
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($detalleRequisicion as $item)
                              <tr>
                                    
                                  <td>
                                        @if ($item->cantidad !=NULL)
                                        {{$item->cantidad}}
                                        @else
                                            -
                                        @endif
                                        
                                    </td>
                                    <td>{{$item->tipoUnidad}}</td>
                                    <td ><b>{{$item->catalogo->nombre}}</b>, {{$item->catalogo->descripcion}}</td>
                              </tr>
                            
                   
                              @endforeach
                          </tbody>
                      </table>
                </div>
                
                    <h6 class="text-center">Elaborado por: <b>{{$requisicion->creado->nombres}}</b>
                    Aprobado por: <b>@if(!isset($requisicion->aceptado))____________ @else $requisicion->aceptado @endif</b>
                    Recibido por: <b>@if(!isset($requisicion->aceptado))____________ @else $requisicion->aceptado @endif</b>
            
                
              

        
        
     
     
    </body>
</html>


                    