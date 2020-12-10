@extends('layouts.app')
@section('title','Roles')
@section('content')
<h1>Roles</h1>
<a class="btn btn-primary" href="{{route('roles.create')}}" role="button">Agregar</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col" >id</th>
            <th scope="col">Nombre</th>
            <th scope="col">descripcion</th>
            <th> Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $item)
        <tr>
            <th scope="row" id="ver" data-toggle="modal" data-target="#staticBackdrop">{{$item->id}}</th>
            <td>{{$item->nombre}}</td>
            <td>{{$item->descripcion}}</td>
            <td>
            <a href="{{route('roles.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
            <a href="" data-toggle="modal" data-target="#staticBackdrop"><i class="material-icons md-18">delete</i></a>
            <a id="ver" data-toggle="modal" data-target=""><i class="material-icons md-18">preview</i></a>
        </td>
        </tr>
        <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form action="{{route('roles.destroy',$item->id)}}" method="delete" autocomplete="off">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Rol</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="nombre">¿Desea dar de baja el rol: {{$item->nombre}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</form>
        @endforeach
    </tbody>
</table>
@endsection