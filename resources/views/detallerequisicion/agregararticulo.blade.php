@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')


<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Agregar articulo a la requisicion</h1>
                    <p>  <a class="" href="{{route('detallerequisiciones.detalle',$requisicion)}}" role="button">Regresar.</a></p>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3>Producto solicitado</h3>
                            </div>
                            <div class=" card-body">
                                <div class="row row-cols-12 row-cols-md-12">
                                    <div class="col mb-4">
                                        <div class="card">
                                            <div class="card h-100">
                                                <img src="{{$detallerequisicion->catalogo->imagen}}" height="100px" width="100px" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$detallerequisicion->catalogo->nombre}}</h5>
                                                    <p class="card-text">{{$detallerequisicion->catalogo->descripcion}}</p>         
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">    
                        <div class="card">
                            <div class="card-header">
                                <h3>ofertas del producto solicitado</h3>
                            </div>
                            <div class=" card-body">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">codigo Articulo</th>
                                        <th scope="col">Periodo</th>
                                        <th scope="col">Precio x Unidad</th>
                                        <th scope="col">Descuento</th>
                                        <th scope="col">Opciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articuloproveedores as $item)
                                            <tr>
                                                <td>{{$item->codigoArticulo}}</td>
                                                <td>{{$item->fechaInicio}} - {{$item->fechaFinal}}</td>
                                                <td>{{$item->precio}}</td>
                                                <td>{{$item->descuento }} %</td>
                                                <td><a href="#" class="badge badge-dark" data-toggle="modal" data-target="#exampleModal{{$item->id}}">+</a></td>
                                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Proveedor: {{$item->proveedor->nombre}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group list-group-vertical">
                                                                <li class="list-group-item">Precio con descuento: <p>$ {{round(((100-$item->descuento)/100)*$item->precio,4)}} USD</p></li>
                                                                <li class="list-group-item">Telefono:   <p>{{$item->proveedor->telefono}}</p></li>
                                                                <li class="list-group-item">Correo:   <p>{{$item->proveedor->correo}}</p></li>
                                                                <li class="list-group-item">Monto minimo a domicilio:   <p>$ {{$item->proveedor->montoMin}} USD</p></li>
                                                                <li class="list-group-item">Periodo de Pago:   <p>{{$item->proveedor->periodoPago}}</p></li>
                                                                <li class="list-group-item">Tiempo Entrega:   <p>{{$item->proveedor->tiempoEntrega}}</p></li>
                                                            </ul>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('detallerequisiciones.agregararticuloproveedor',[$detallerequisicion,$item->id])}}" method="post" autocomplete="off"> 
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="btn btn-success">Elegir</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>                     
        </div>
    </div> 
</div>   
@endsection