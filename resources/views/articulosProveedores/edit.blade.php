@extends('layouts.app')
@section('title','Editar Articulos-Proveedores')
@section('content')


<h1>Editar Articulos-Proveedor</h1>
<div class="container">
    <div class="row ">

        <div class="card col-md-4" style="width: 18rem;">
            <img src="{{$articuloProveedor->catalogo->imagen}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$articuloProveedor->catalogo->nombre}}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$articuloProveedor->catalogo->descripcion}}</li>
            </ul>
        </div>
        <div class="card col-md-8">
        <x-jet-validation-errors class="mb-4" />
        <form action="{{route('articulosProveedores.update',$articuloProveedor)}}" method="POST" autocomplete="off">
            @csrf<!-- para crear un token oculto por temas de seguridad  -->
            @method('put')
            <div class="card" >
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="codigoArticulo">codigo Articulo</label>
                            <input id="codigoArticulo" type="text" class="form-control"  value="{{old('codigoArticulo', $articuloProveedor->codigoArticulo)}}"name="codigoArticulo" placeholder="codigoArticulo">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="fechaInicio">Fecha Inicio</label>
                            <input id="fechaInicio" type="date" class="form-control"  value="{{old('fechaInicio',$articuloProveedor->fechaInicio)}}"name="fechaInicio" placeholder="fechaInicio">
                        </div>
                            <div class="form-group col-md-4">
                            <label for="fechaFinal">Fecha Final</label>
                            <input id="fechaFinal" type="date" class="form-control"  value="{{old('fechaFinal',$articuloProveedor->fechaFinal)}}"name="fechaFinal" placeholder="fechaFinal">
                        </div>
                            <div class="form-group col-md-4">
                            <label for="precio">Precio unitario</label>
                            <input id="precio" type="money" min="0.00" max="100000.00" step="0.01" class="form-control"  value="{{old('precio',$articuloProveedor->precio)}}"name="precio" placeholder="Precio $ USD"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="descuento">Descuento</label>
                            <input id="descuento" type="number" min="0.00" max="100.00" step="0.01" class="form-control"  value="{{old('descuento',$articuloProveedor->descuento)}}"name="descuento" placeholder="% de descuento">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            
        </form>
        </div>
    </div>
</div>

@endsection