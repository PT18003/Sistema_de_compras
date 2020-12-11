@extends('layouts.app')
@section('title','Reporte')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Reporte de articulos ordenados por empleado</h1>
                    <p>  <a class="" href="{{route('dashboard')}}" role="button">Regresar.</a></p>
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
                                            <span class="text-right"><a class=" badge bg-success text-light text-right" href="{{route('detallerequisiciones.detalle',$requi->id)}}">Consultar</a></span>
                                                 @if($requi->aceptado_id!=null)
                                                    <span class="badge bg-primrary text-light">Aceptada   {{$requi->fechaAceptada}} </span>
                                                  
                                                  
                                                @else
                                                     <span class="badge bg-danger text-light">No Aceptada</span>
                                                @endif
                                            @else
                                           <span class="badge bg-secondary text-light">No Enviada</span>
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
                <a class="btn btn-info" href="{{route('artempleadosPdf')}}">Generar PDF</a>          
                    

            </div>
                      
        </div>
    </div> 
</div>  

{{--$suma--}}
@endsection
