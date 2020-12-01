@extends('layouts.app')
@section('title','Agregar Catálogo')

@section('content')
<h1>Agregar Catálogo</h1>
<form action="{{route('catalogos.create')}}" enctype="multipart/form-data" method="POST">
@csrf
    @csrf<!-- para crear un token oculto por temas de seguridad  -->
    <div class="form-row">
      <div class="col">
        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre del producto">
      </div>
      <div class="col">
        <input type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripcion del producto">
      </div>
      <div class="col">
        <input type="file" class="form-control" name="imagen" accept=".png, .jpg, .jpeg">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Agregar</button>
  </form>
@endsection