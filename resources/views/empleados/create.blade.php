@extends('layouts.app')
@section('title','Agregar Nuevo Empleado')
@section('content')


<h1>Agregar Empleado</h1>
<div class="container">
    <form action="{{route('empleados.guardar')}}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nombres">Nombres</label>
                <input id="nombres" type="text" class="form-control" name="nombres" placeholder="Nombres ">
            </div>
            <div class="form-group col-md-4">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" type="text" class="form-control" name="apellidos" placeholder="Apellidos">
            </div>
            <div class="form-group col-md-4">
                <label for="genero">Genero</label>
                <select class="custom-select mr-sm-2" id="genero" name="genero">
                    <option selected>Seleccione</option>
                    @foreach ($generos as $item)
                    <option value="{{$item->id}}">{{$item->genero}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="estadocivil">Estado civil</label>
                <select class="custom-select mr-sm-2" id="estadocivil" name="estadocivil">
                    <option selected>Seleccione</option>
                    @foreach ($estadocivil as $item)
                    <option value="{{$item->id}}">{{$item->nombreEstado}}</option>
                    @endforeach 
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="departamento">Departamento</label>
                <select class="custom-select mr-sm-2" id="departamento" name="departamento" >
                    <option selected>Seleccione</option>
                    @foreach ($departamentos as $item)
                    <option value="{{$item->id}}">{{$item->departamento}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="municipio">Municipio</label>
                <select class="custom-select mr-sm-2" id="municipio" name="municipio" >
                    <option selected>Seleccione</option>
                    <option id="municipio" ></option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="direccion">Direccion</label>
                <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Direccion: ej. #calle, #pasaje, Av.">
            </div>
            <div class="form-group col-md-2">
                <label for="telefono">Telefono</label>
                <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Telefono">
            </div>
            <div class="form-group col-md-2">
                <label for="dui">DUI</label>
                <input id="dui" type="text" class="form-control" name="dui" placeholder="DUI, sin guion">
            </div>
            <div class="form-group col-md-2">
                <label for="salario">Salario</label>
                <input id="salario" type="number" class="form-control" name="salario" placeholder="Salario USD">
            </div>
            <div class="form-group col-md-2">
                <label for="vencimientoContrato">Vencimiento de contrato</label>
                <input id="vencimientoContrato" type="date" class="form-control" name="vencimientoContrato" placeholder="Vencimiento de contrato">
            </div>
            <div class="form-group col-md-4">
                <label for="areatrabajo">Area de trabajo</label>
                <select class="custom-select mr-sm-2" id="areatrabajo" name="areatrabajo">
                    <option selected>Seleccione</option>
                    @foreach ($areatrabajo as $item)
                    <option value="{{$item->id}}">{{$item->nombreDep}}</option>
                    @endforeach
                </select>
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>

            </div>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

@endsection