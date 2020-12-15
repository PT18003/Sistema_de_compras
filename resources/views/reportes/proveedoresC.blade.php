@extends('layouts.app')
@section('title','Reporte Areas de Trabajo')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Ordenes de compra por proveedores</h1>
                    <p>  <a class="" href="{{route('dashboard')}}" role="button">Regresar.</a></p>
                </div>
            


                 <table class="table table-hover table-bordered">
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

                            <td class="text-center">
                            @foreach ($join as $row)
                                @if($item->id == $row->id)
                                
                                     <div class="card mt-2 mb-4 card-block">
                                        <div class="card-body">
                                        <b>Monto: </b>
                                       
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
                                            <b>Orden de compra: </b>
                                            {{$row->ordenCompra}}
                                            <b>Articulos: </b>
                                             {{$suma}}
                                            <b>Fecha creada: </b>
                                            {{$creada}}
                                             <span class="text-right"><a class=" badge bg-success text-light text-right" href="{{route('detallerequisiciones.detalle',$row->rid)}}">Consultar requisicion</a></span>
                                           
                                       
                                       
                                        </div>
                                    </div>
                                @endif    
                            @endforeach
                            </td>
                       
                        
                      
                        </tr>
                      @endforeach
                    </tbody>
                </table>   
                 <a class="btn btn-info" href="{{route('proveedorCPdf')}}">Generar PDF</a> 
               
            
            </div>
                      
        </div>
    </div> 
</div>  

{{--$suma--}}
@endsection
