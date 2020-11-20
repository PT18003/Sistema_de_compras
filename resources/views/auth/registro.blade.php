
    
@extends('layouts.app')
@section('title','Empleados')
@section('content')

        <x-jet-validation-errors class="mb-4" />

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
              
              <input id="id" type="text" class="form-control d-none" name="id"  value="{{$empleado->id}}">
              
            </div>
            <x-jet-button class="ml-4">
                {{ __('Register') }}
            </x-jet-button>
          </form>
        @endsection