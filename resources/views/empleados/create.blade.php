@extends('layouts.app')
@section('title','Agregar Nuevo Empleado')
@section('content')

 <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">
                    <h1>Agregar Empleado</h1>
                    <p>  <a class="" href="{{route('empleados.index')}}" role="button">Regresar.</a></p>
                    </div>   

<h1>Agregar Empleado</h1>
<div class="container">
    <x-jet-validation-errors class="mb-4" />
    <form action="{{route('empleados.guardar')}}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nombres">Nombres</label>
            <input id="nombres" type="text" value="{{old('nombres')}}" class="form-control" name="nombres" placeholder="Nombres ">
            </div>
            <div class="form-group col-md-4">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" value="{{old('apellidos')}}" class="form-control" name="apellidos" placeholder="Apellidos">
            </div>
            <div class="form-group col-md-4">
                <label for="genero">Genero</label>
                <select class="custom-select mr-sm-2" id="genero" name="genero">
                    <option selected>Seleccione</option>
                    @foreach ($generos as $item)
                        @if (old('genero')==$item->id)
                            <option value="{{$item->id}}" selected>{{$item->genero}}</option>
                        @else
                            <option value="{{$item->id}}" >{{$item->genero}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="estadocivil">Estado civil</label>
                <select class="custom-select mr-sm-2" id="estadocivil" name="estadocivil">
                    <option selected>Seleccione</option>
                    @foreach ($estadocivil as $item)
                    @if (old('estadocivil')==$item->id)
                    <option value="{{$item->id}}" selected>{{$item->nombreEstado}}</option>
                    @else
                    <option value="{{$item->id}}">{{$item->nombreEstado}}</option>
                    @endif
                    
                    @endforeach 
                </select>
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
                        @foreach ($municipios as $item)
                            <option selected>Seleccione</option>
                            @if (old('municipio')==$item->id)
                                <option value="{{$item->id}}" selected>{{$item->municipio}}</option> 
                            @else
                                <option value="{{$item->id}}">{{$item->municipio}}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
             <div class="form-group col-md-3">
                                    <label for="direccion">Direccion</label>
                                    <input id="direccion" type="text" class="form-control" {{old('direccion')}} name="direccion" placeholder="Direccion: ej. #calle, #pasaje, Av.">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="telefono">Telefono</label>
                                    <input id="telefono" type="text" class="form-control" {{old('telefono')}} name="telefono" placeholder="Telefono">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="dui">DUI</label>
                                    <input id="dui" type="text" class="form-control" {{old('dui')}} name="dui" placeholder="DUI, sin guion">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="salario">Salario</label>
                                    <input id="salario" type="number" step=0.01 class="form-control" {{old('salario')}} name="salario" placeholder="Salario USD">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="vencimientoContrato">Vencimiento de contrato</label>
                                    <input id="vencimientoContrato" type="date" class="form-control" value="{{old('vencimientoContrato',date('Y-m-d'))}}" name="vencimientoContrato" placeholder="Vencimiento de contrato">
                                </div>
                              
                                <div class="form-group col-md-4">
                                    <label for="areatrabajo">Area de trabajo</label>
                                    <select class="custom-select mr-sm-2" id="areatrabajo" name="areatrabajo">
                                        <option selected>Seleccione</option>
                                        @foreach ($areatrabajo as $item)
                                        @if (old('areatrabajo')==$item->id)
                                            <option value="{{$item->id}}" selected>{{$item->nombreDep}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->nombreDep}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
        </div> 
    </div>  

@endsection