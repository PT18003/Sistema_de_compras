@extends('layouts.app')
@section('title','Modificar Catálogo')

@section('content')
<h1>Modificar Catálogo</h1>
<form action="{{route('catalogos.actualizar')}}" enctype="multipart/form-data" method="POST">
    @csrf<!-- para crear un token oculto por temas de seguridad  -->
    @method('put')
      <img class="mx-auto" src="{{$catalogo[0]->imagen}}" alt="" height="150px" width="150px">
    <div class="form-row m-6">
        <input type="text" class="form-control" style="display:none" name="id" value="{{$catalogo[0]->id}}">
    </div>
    <div class="col m-3">
        <input type="text" class="form-control" name="nombre" value="{{$catalogo[0]->nombre}}">
    </div>
    <div class="col m-3">
        <input type="text" class="form-control" name="descripcion" value="{{$catalogo[0]->descripcion}}">
    </div>
    <div class="container">
      </div>
    <div class="col m-3">
        <input type="file" class="form-control" name="imagen" accept=".png, .jpg, .jpeg">
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Modificar</button>
  </form>
@endsection