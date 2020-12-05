@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')


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
        <x-jet-validation-errors class="mb-4" /> 
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