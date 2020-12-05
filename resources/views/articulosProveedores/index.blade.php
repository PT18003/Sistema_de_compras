@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')

 <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                <h2>Catalogo de Productos</h2>
                <p><a class="" href="{{route('proveedores.index')}}" role="button">Regresar.</a></p>
                </div>
    
                        
                <form method="post" action="{{route('articulosProveedores.store',$proveedor)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        @foreach ($catalogo as $item)
                        <div class="col-sm-4 py-2" >
                            <div class="card h-100 card-inverse card-info">
                                <img src="{{$item->imagen}}"alt="...">
                                <div class="card-body">
                                    <h5 class="card-title ">{{$item->nombre}}</h5>
                                    <p class="card-text text-sm">{{$item->descripcion}}</p>
                                                
                                </div>
                                        
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
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Agregar</button>
                </form>
                 <x-jet-validation-errors class="mb-4" />  
                       
       
            </div>
        </div>
    </div>
</div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                <h2>Productos Actualmente Ofertados por  <b>{{$proveedor->nombre}} </b></h2>
                
                </div>
                 <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                              
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
                                    <td rowspan="3" height=100 width=300><img src="{{$item->catalogo->imagen}}" alt="" border=3 ></td>
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
        </div>
    </div>

@endsection