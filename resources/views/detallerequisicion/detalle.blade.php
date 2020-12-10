@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Detalle de mi requisicion</h1>
                    <p>  <a class="" href="{{route('detallerequisiciones.index',$requisicion)}}" role="button">Regresar.</a></p>
                </div>
                <div class="">
                    @if ($acceso==2){{-- VISTA SOLO PARA LOS QUE SON DE COMPRAS --}}
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="6"> <p class="h3 text-center">Articulos de mi requisicion</p></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Articulo Proveedor</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleRequisicion as $item)
                                    <tr>
                                        <td >{{$item->catalogo->nombre}}</td>
                                        <td>
                                            @if ($item->cantidad !=NULL)
                                            {{$item->cantidad}}
                                            @else
                                                -
                                            @endif
                                            
                                        </td>
                                        
                                        <td>{{$item->tipoUnidad}}</td>
                                        @if ($item->id_articuloProveedor==NULL)
                                            <td><a href="{{route('detallerequisiciones.agregararticulo',[$item->requisicion_id, $item->id])}}" class="badge badge-warning">Agrear</a></td>
                                        @else   
                                            <td>
                                                <a href="#" class="badge badge-dark" data-toggle="modal" data-target="#exampleModal{{$item->id}}">Mostrar</a>-
                                            <a href="{{route('detallerequisiciones.agregararticulo',[$item->requisicion_id, $item->id])}}" class="badge badge-warning">Cambiar</a></td>
                                        @endif
                                       

                                    </tr>
                                    @if ($item->id_articuloProveedor==NULL)

                                    @else   
                                        <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Proveedor: {{$item->articuloProveedor->proveedor->nombre}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group list-group-vertical">
                                                        <li class="list-group-item">Precio con descuento: <p>$ {{round(((100-$item->articuloProveedor->descuento)/100)*$item->articuloProveedor->precio,4)}} USD</p></li>
                                                        <li class="list-group-item">Telefono:   <p>{{$item->articuloProveedor->proveedor->telefono}}</p></li>
                                                        <li class="list-group-item">Correo:   <p>{{$item->articuloProveedor->proveedor->correo}}</p></li>
                                                        <li class="list-group-item">Monto minimo a domicilio:   <p>$ {{$item->articuloProveedor->proveedor->montoMin}} USD</p></li>
                                                        <li class="list-group-item">Periodo de Pago:   <p>{{$item->articuloProveedor->proveedor->periodoPago}}</p></li>
                                                        <li class="list-group-item">Tiempo Entrega:   <p>{{$item->articuloProveedor->proveedor->tiempoEntrega}}</p></li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                
                                                </div>
                                            </div>
                                            </div>
                                        </div> 
                                    @endif
                                    
                                    @endforeach
                                        @if ($permiso==1 && $requisicion->estado_req==2)
                                            <form action="{{route('requisiciones.ordenar',$requisicion)}}" method="post" autocomplete="off"> 
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                        @else
                                            
                                        @endif
                                </tbody>
                            </table>
                            @if ($requisicion->estado_req==1 && $acceso==3)
                            <form action="{{route('requisiciones.aceptar',$requisicion)}}" method="post" autocomplete="off">
                                @csrf
                                @method('put') 
                                <button type="submit" class="btn btn-success">Aceptarla</button>
                            </form>
                            <form action="{{route('requisiciones.denegar',$requisicion)}}" method="post" autocomplete="off">
                                @csrf
                                @method('put') 
                                <button type="submit" class="btn btn-danger">Denegar</button>
                            </form>
                            
                            @endif

                        </div>
                    @else
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="6"> <p class="h3 text-center">Articulos de mi requisicion</p></th>
                                </tr>
                                <tr>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Unidad</th>
                                    @if ($acceso==3){{-- para mostrar las acciones --}}
                                        
                                    @else
                                        @if($acceso==1)
                                        <th scope="col">Acciones</th>
                                        @endif
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleRequisicion as $item)
                                <tr>
                                    <td >{{$item->catalogo->nombre}}</td>
                                    <td>
                                        @if ($item->cantidad !=NULL)
                                        {{$item->cantidad}}
                                        @else
                                            -
                                        @endif
                                        
                                    </td>
                                    <td>{{$item->tipoUnidad}}</td>
                                    @if ($acceso==3){{-- para mostrar las acciones --}}
                                        
                                    @else
                                        @if($acceso==1)
                                        <td>
                                            @if ($requisicion->estado_req==0)
                                            <a href="{{route('detallerequisiciones.edit',[$item->requisicion_id,$item->id])}}"><i class="material-icons md-18">edit</i></a>
                                            <a data-toggle="modal" data-target="#staticBackdrop{{$item->id}}" ><i class="material-icons md-18 text-danger">delete</i></a>        
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @endif
                                    @endif

                                </tr>
                                <div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <form action="{{route('detallerequisiciones.destroy',$item)}}" method="delete" autocomplete="off"> 
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Articulo de mi requisicion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="nombre">¿Desea dar de baja al articulo {{$item->catalogo->nombre}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                                @if ($permiso==1 && $requisicion->estado_req==0)
                            <form action="{{route('requisiciones.send',$requisicion)}}" method="post" autocomplete="off"> 
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </form>
                                @else
                                    
                                @endif
                            </tbody>
                        </table>
                        @if ($requisicion->estado_req==1 && $acceso==3)
                        <form action="{{route('requisiciones.aceptar',$requisicion)}}" method="post" autocomplete="off">
                            @csrf
                            @method('put') 
                            <button type="submit" class="btn btn-success">Aceptarla</button>
                        </form>
                        <form action="{{route('requisiciones.denegar',$requisicion)}}" method="post" autocomplete="off">
                            @csrf
                            @method('put') 
                            <button type="submit" class="btn btn-danger">Denegar</button>
                        </form>
                        
                        @endif

                    </div>
                    @endif
   
                </div>

            </div>                     
        </div>
    </div> 
</div>  
@endsection