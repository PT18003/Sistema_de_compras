@extends('layouts.app')
@section('title','Generos')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Generos</h1>
                    <p>  <a class="" href="{{route('generos.create')}}" role="button">Agregar.</a></p>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($generos as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->genero}}</td>
                            <td>
                            <a href="{{route('generos.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
                            <a href="{{route('generos.destroy',$item)}}"><i class="material-icons md-18">delete</i></a>
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
