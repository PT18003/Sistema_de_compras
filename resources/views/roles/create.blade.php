@extends('layouts.app')
@section('title','Agregar Nuevo Rol')
@section('content')


<h1>Agregar Rol</h1>
<div class="container">
    <form action="{{route('roles.store')}}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group col-md-4">
                <label for="descripcion">Descripcion</label>
                <input id="descripcion" type="text" class="form-control" name="descripcion" placeholder="descripcion">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>

@endsection