@extends('layouts.app')
@section('title','Agregar Nuevo Proveedor')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                   <h1>Agregar Proveedor</h1>
                    <p>  <a class="" href="{{route('proveedores.index')}}" role="button">Regresar.</a></p>
                </div>

                    <div class="container">
                        <x-jet-validation-errors class="mb-4" />
                        <form action="{{route('proveedores.store')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="departamento">Departamento</label>
                                    <select class="custom-select mr-sm-2" id="departamento" name="departamento" >
                                        <option selected>Seleccione</option>
                                        @foreach ($departamentos as $item)
                                            @if (old('departamento')==$item->id)
                                                <option value="{{$item->id}}" selected>{{$item->departamento}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->departamento}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="municipio">Municipio</label>
                                    <select class="custom-select mr-sm-2" id="municipio" name="municipio" >
                                        <option selected>Seleccione</option>
                                        @foreach ($municipios as $item)
                                            
                                            @if (old('municipio')==$item->id)
                                                <option value="{{$item->id}}" selected>{{$item->municipio}}</option> 
                                            @else
                                                <option value="{{$item->id}}">{{$item->municipio}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="direccion">Direccion</label>
                                    <input id="direccion" type="text" class="form-control" name="direccion" placeholder="direccion">
                                </div>
                                
                                <div class="form-group col-md-2">
                                    <label for="telefono">Telefono</label>
                                    <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Telefono">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="correo">Correo</label>
                                    <input id="correo" type="text" class="form-control" name="correo" placeholder="correo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="nit">NIT</label>
                                    <input id="nit" type="text" class="form-control" name="nit" placeholder="nit">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="montoMin">Monto Minimo</label>
                                    <input id="montoMin" type="number" class="form-control" name="montoMin" placeholder="montoMin">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tiempoEntrega">Tiempo de Entrega (dias)</label>
                                    <input id="tiempoEntrega" type="number" class="form-control"  value="{{old('tiempoEntrega')}}"name="tiempoEntrega" placeholder="tiempoEntrega (dias)">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="periodoPago">Periodo Pago (dias)
                                    </label>
                                    <input id="periodoPago" type="number" class="form-control"  value="{{old('periodoPago')}}"name="periodoPago" placeholder="Periodo de Pago (dias)">
                                </div>
                            </div>
                             <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                         
                    </div>

                </div>
            </div>
        </div>
    </div>  
      
@endsection