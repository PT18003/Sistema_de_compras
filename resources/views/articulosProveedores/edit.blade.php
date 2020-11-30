@extends('layouts.app')
@section('title','Editar Articulos-Proveedores')
@section('content')

  <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">
                    <h1>Editar Articulos-Proveedor</h1>
                    <p>  <a class="" href="{{route('articulosProveedores.index')}}" role="button">Regresar.</a></p>
                    </div>                 
                    <div class="container">
                        <form action="{{route('articulosProveedores.update',$articulosProveedor)}}" method="POST" autocomplete="off">
                            @csrf<!-- para crear un token oculto por temas de seguridad  -->
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inventario">Inventario</label>
                                    <select class="custom-select mr-sm-2" id="inventario" name="inventario" >
                                        <option selected>Seleccione</option>
                                        @foreach ($inventarios as $item)
                                        <option @if ($item->id==$articulosProveedor->inventario->id)
                                            selected
                                        @endif value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="proveedor">proveedor</label>
                                    <select class="custom-select mr-sm-2" id="proveedor" name="proveedor" >
                                        <option value=0 selected>Seleccione</option>
                                    @foreach ($proveedores as $item)
                                        <option @if ($item->id==$articulosProveedor->proveedor->id)
                                            selected
                                        @endif value="{{$item->id}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="codigoArticulo">codigoArticulo</label>
                                    <input id="codigoArticulo" type="text" class="form-control"  value="{{$articulosProveedor->codigoArticulo}}"name="codigoArticulo" placeholder="codigoArticulo">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="descripcionRol">descripcionRol</label>
                                    <input id="descripcionRol" type="text" class="form-control"  value="{{$articulosProveedor->descripcionRol}}"name="descripcionRol" placeholder="descripcionRol">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fechaInicio">fechaInicio</label>
                                    <input id="fechaInicio" type="date" class="form-control"  value="{{$articulosProveedor->fechaInicio}}"name="fechaInicio" placeholder="fechaInicio">
                                </div>
                                    <div class="form-group col-md-4">
                                    <label for="fechaFinal">fechaFinal</label>
                                    <input id="fechaFinal" type="date" class="form-control"  value="{{$articulosProveedor->fechaFinal}}"name="fechaFinal" placeholder="fechaFinal">
                                </div>
                                    <div class="form-group col-md-4">
                                    <label for="precio">Precio</label>
                                    <input id="precio" type="number" class="form-control"  value="{{$articulosProveedor->precio}}"name="precio" placeholder="precio">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="periodoPago">PeriodoPago</label>
                                    <input id="periodoPago" type="text" class="form-control"  value="{{$articulosProveedor->periodoPago}}"name="periodoPago" placeholder="periodoPago">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="descuento">descuento</label>
                                    <input id="descuento" type="number" class="form-control"  value="{{$articulosProveedor->descuento}}"name="descuento" placeholder="descuento">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tiempoEntrega">tiempoEntrega</label>
                                    <input id="tiempoEntrega" type="time" class="form-control"  value="{{$articulosProveedor->tiempoEntrega}}"name="tiempoEntrega" placeholder="tiempoEntrega">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                    @endsection
                </div>
            </div>
        </div>
    </div>