                
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        
    </head>
    <body class="card-body">
          <h3 class="text-center"><b> Sistema de compras TOO115 S.A</b></h3>
          <h5 class="text-center"> Ruc. 129391-9283</h5>
         <h5 class="text-center">
           <a> Orden de compra</a> 
           No: <b> {{$requisicion->id}}</b>
           Proveedor: 
            <?php 
            $provv = 0;
           
             foreach ($detalleRequisicion as $detalle)       
                    foreach($detalle->catalogo->proveedor as $proveedor)
                        $provv = $proveedor
                   
             ?>
            {{$provv->nombre}}
        
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
       
                   Fecha de pago: <b>
                    <?php
                        $date_now = $requisicion->created_at;
                        $date_future = strtotime('+'.$provv->periodoPago.'day', strtotime($date_now));
                        $date_future = date('d-m-Y', $date_future);
                        echo $date_future;
                    ?>
                    </b></h6>
                    </p>
                
                   <div class="">
                        <p class="">por este medio suministraran los siguientes articulos</p>
                      <table class="table table-sm  table-bordered">
                        
                          <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col" class="text-center">Unidad</th>
                                    <th scope="col" class="text-center">Articulo</th>
                                    <th scope="col" class="text-center">Precio Unitario</th>
                                    <th scope="col" class="text-center">Precio Unitario con descuento</th>
                                    <th scope="col" class="text-center">Precio total</th>
                                    
                                  
                                  
                              </tr>
                          </thead>
                          <tbody>
                          
                              @foreach ($detalleRequisicion as $item)
                              <tr>
                                  <td>{{$item->id}}</td>
                                  <td>
                                        @if ($item->cantidad !=NULL)
                                        {{$item->cantidad}}
                                        @else
                                            -
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">{{$item->tipoUnidad}}</td>
                                    <td class="text-center"><b>{{$item->catalogo->nombre}}</b>, {{$item->catalogo->descripcion}}</td>
                                    <td class="text-center">$ {{$item->articuloProveedor->precio}} USD</td>
                                    <td class="text-center">$ {{round(((100-$item->articuloProveedor->descuento)/100)*$item->articuloProveedor->precio,4)}} USD</td>
                                    <td class="text-center">$ {{round((((100-$item->articuloProveedor->descuento)/100)*$item->articuloProveedor->precio)*($item->cantidad),4)}} USD</td>
                                    
                              </tr>
                            
                   
                              @endforeach
                              <?php
                              $suma = 0;
                              foreach ($detalleRequisicion as $item)
                              {
                                  $suma= $suma + (round((((100-$item->articuloProveedor->descuento)/100)*$item->articuloProveedor->precio)*($item->cantidad),4));
                                  
                              }
                              
                              ?>
                              <tr><td colspan="6" class="text-right">Total:</td><td class="text-center"><b>$ {{$suma}} USD</b></td></tr>
                          </tbody>
                      </table>
                </div>
                
                    <h6 class="text-center">Elaborado por: <b>{{$requisicion->creado->nombres}}</b>
                    Aprobado por: <b>@if(!isset($requisicion->aceptado))____________ @else {{$requisicion->aceptado->nombres}} @endif</b>
                    Recibido por: <b>@if(!isset($requisicion->encargado))____________ @else {{$requisicion->encargado->nombres }}@endif</b>
            
                
          
        
     
     
    </body>
</html>


                    