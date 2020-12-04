@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')

  <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">
                    <h1>Articulos Proveedores</h1>
                    <p>  <a class="" href="{{route('articulosProveedores.create')}}" role="button">Agregar</a></p>
                    </div>              
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" >id</th>
                                <th scope="col">Inventario</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Codigo articulo</th>
                                <th scope="col">Descripcion de Rol </th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecga Final</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Periodo de pago</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Tiempo de entrega</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articulosProveedores as $item)
                            <tr>
                                <th scope="row" id="ver" data-toggle="modal" data-target="#staticBackdrop">{{$item->id}}</th>
                                <td>{{$item->inventario->nombre}}</td>
                                <td>{{$item->proveedor->nombre}}</td>
                                <td>{{$item->codigoArticulo}}</td>
                                <td>{{$item->descripcionRol}}</td>
                                <td>{{$item->fechaInicio}}</td>
                                <td>{{$item->fechaFinal}}</td>
                                <td>{{$item->precio}}</td>
                                <td>{{$item->periodoPago}}</td>
                                <td>{{$item->descuento}}</td>
                                <td>{{$item->tiempoEntrega}}</td>
                                <td>
                                <a href="{{route('articulosProveedores.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
                                <a href="" data-toggle="modal" data-target="#staticBackdrop"><i class="material-icons md-18">delete</i></a>
                                <a id="ver" data-toggle="modal" data-target=""><i class="material-icons md-18">preview</i></a>
                            </td>
                            </tr>
                            <!-- Button trigger modal -->

                      
                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <form action="{{route('articulosProveedores.destroy',$item->id)}}" method="delete" autocomplete="off">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Articulo-Proveedor</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p id="nombre">¿Desea dar de baja al Articulo-Proveedor: {{$item->codigoArticulo}}</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $articulosProveedores->links() }}
                  
                </div>
            </div>
        </div>
    </div>
    @endsection
<h1>Articulos de Proveedores</h1>
<a class="btn btn-primary" href="{{-- {{route('articulosProveedores.index')}} --}}" role="button">Agregar</a>
<x-jet-validation-errors class="mb-4" />
<div class="container">
    <div class="card">
        <div class="card-header">
          <h2>Catalogo de Productos</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('articulosProveedores.store',$proveedor)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row row-cols-1 row-cols-md-3">
                @foreach ($catalogo as $item)
                <div class="col mb-4">
                    <div class="card">
                        <div class="card h-100">
                            <img src="{{$item->imagen}}" height="100px" width="100px" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->nombre}}</h5>
                                <p class="card-text">{{$item->descripcion}}</p>
                                <div class="card-footer">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="catalogo[]" value="{{ $item->id }}"  id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Seleccionar
                                          </label>
                                    </div>
                                </div>                  
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>  
        </div>
      </div>
      <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6"> <p class="h3 text-center">Productos de: {{$proveedor->nombre}}</p></th>
                </tr>
                <tr>
                    <th scope="col"># id</th>
                    <th scope="col">Articulo</th>
                    <th scope="col">Info. del proveedor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulosProveedores as $item)
                <tr>
                    <td rowspan="3"><img src="{{$item->catalogo->imagen}}" height="80px" width="80px" alt=""> </td>
                    <td><p class="font-weight-bold">Id Catalogo: </p>{{$item->id_catalogo}}</td>
                    <td><p class="font-weight-bold">Fecha Inicio: </p>{{$item->fechaInicio}}</td>
                    <td rowspan="3" >
                        <a href="{{route('articulosProveedores.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
                        <a data-toggle="modal" data-target="#staticBackdrop" ><i class="material-icons md-18 text-danger">delete</i></a>        
                    </td>
                </tr>
                <tr>
                    <td rowspan="2"><p class="font-weight-bold">Nombre: </p>{{$item->catalogo->nombre}}</td>
                    <td><p class="font-weight-bold">Fecha Fin: </p>{{$item->fechaFinal}}</td>
                </tr>
                <tr>
                    <td><p class="font-weight-bold">Precio Unitario: </p>{{$item->precio}}</td>
                </tr>
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form action="{{route('articulosProveedores.destroy',$item)}}" method="delete" autocomplete="off">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Articulo del Proveedor</h5>
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
            </tbody>
        </table>
    </div>
</div>
@endsection
