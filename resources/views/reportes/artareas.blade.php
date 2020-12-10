@extends('layouts.app')
@section('title','Reporte Areas de Trabajo')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Reporte de articulos ordenados por Areas de Trabajo</h1>
                    <p>  <a class="" href="{{route('dashboard')}}" role="button">Regresar.</a></p>
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
                                            <span class="text-right"><a class=" badge bg-success text-light text-right" href="{{route('detallerequisiciones.detalle',$elemento->id)}}">Consultar</a></span>
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
                 <a class="btn btn-info" href="{{route('artareasPdf')}}">Generar PDF</a>  
                 
            </div>
                      
        </div>
    </div> 
</div>  

{{--$suma--}}
@endsection
