@extends('layouts.app')
@section('title','productos')
@section('content')

<div class="py-12"> 
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                <h1>Catálogo</h1>
                <p>  <a class="" href="{{route('catalogos.create')}}" role="button">Agregar.</a></p>
                </div>   

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="d-none">id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($catalogos as $item)
                        <tr>
                            <th scope="row" class="d-none">{{$item->id}}</th>
                            <th scope="row">{{$item->nombre}}</th>
                            <th scope="row" style="max-width: 300px;">{{$item->descripcion}}</th>
                            <th scope="row" height=150 width=150 ><img src="{{$item->imagen}}" alt=""></th>
                            <td>
                                <a href="{{route('catalogos.edit',['catalogo'=>$item->id])}}"><i class="material-icons md-18">edit</i></a>
                                <a href="{{route('catalogos.destroy',['catalogo'=>$item->id])}}"><i class="material-icons md-18">delete</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
