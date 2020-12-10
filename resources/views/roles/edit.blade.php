@extends('layouts.app')
@section('title','Editar Rol')
@section('content')


<h1>Editar Rol</h1>
<div class="container">
    <form action="{{route('roles.update',$rol)}}" method="POST" autocomplete="off">
        @csrf<!-- para crear un token oculto por temas de seguridad  -->
        @method('put')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nombre">Nombre</label>
            <input id="nombre" type="text" class="form-control" value="{{$rol->nombre}}" name="nombre" placeholder="Nombre ">
            </div>
        
            <div class="form-group col-md-4">
                <label for="descripcion">Descripcion</label>
                <input id="descripcion" type="text" class="form-control"  value="{{$rol->descripcion}}"name="descripcion" placeholder="descripcion">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection