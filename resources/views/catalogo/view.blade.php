@extends('layouts.app')
@section('title','productos')
@section('content')


<h1>Catálogo</h1>

<a class="btn btn-primary" href="{{route('catalogos.create')}}" role="button">Agregar</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Imagen</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($catalogos as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <th scope="row">{{$item->nombre}}</th>
            <th scope="row">{{$item->descripcion}}</th>
            <th scope="row"><img src="{{$item->imagen}}" height="60px" width="60px" alt=""></th>
            <td>
                <a href="{{route('catalogos.edit',['catalogo'=>$item->id])}}"><i class="material-icons md-18">edit</i></a>
                <a href="{{route('catalogos.destroy',['catalogo'=>$item->id])}}"><i class="material-icons md-18">delete</i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
