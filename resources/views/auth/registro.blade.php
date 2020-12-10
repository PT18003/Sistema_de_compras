
@extends('layouts.app')
@section('title','Empleados')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <x-jet-validation-errors class="mb-4" />
            <div class="container card-body ">                  
                <div class="branding">
                <h1>Crear usuario a Empleado <b>{{$empleado->nombres}}</b></h1>
                <p>  <a class="" href="{{route('empleados.index')}}" role="button">Regresar.</a></p>
                </div>   

                <form action="{{route('registrar')}}" method="POST">
                    @csrf
                    <div class="form-row">
                      <div class="col-md-4">
                        <label for="name">Nombre</label>
                      <input id="name" type="text" class="form-control" name="name" placeholder="Nombre" readonly value="{{$empleado->nombres}}">
                      </div>
                      <div class="col-md-4">
                        <label for="email">correo</label>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Correo electronico">
                      </div>
                      <div class="col-md-4">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Cotnraseña">
                      </div>
                      <div class="col-md-4">
                        <label for="password_confirmation">Repite laContraseña</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Repite la contraseña">
                      </div>
                      @if (Auth::user()->admin())
                      <div class="form-group col-md-4">
                <label for="rol">Rol</label>
                <select class="custom-select mr-sm-2" id="id_rol" name="id_rol">
                    <option selected>Seleccione</option>
                    @foreach ($roles as $item)
                        @if (old('rol')==$item->id)
                            <option value="{{$item->id}}" selected>{{$item->nombre}}</option>
                        @else
                            <option value="{{$item->id}}" >{{$item->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div> @endif
                      
                      <input id="id" type="text" class="form-control d-none" name="id"  value="{{$empleado->id}}">
                      
                    </div>
                    <x-jet-button class="ml-4 btn btn-primary mt-3">
                        {{ __('Guardar') }}
                    </x-jet-button>
                  </form>
                </div>
            </div>
        </div>
    </div>
               
  @endsection