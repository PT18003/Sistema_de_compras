@extends('layouts.app')
@section('title','Municipios')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                   <h1>Municipios</h1>
                    <p>  <a class="" href="{{route('municipios.create')}}" role="button">Agregar.</a></p>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Municipio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($municipios as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->departamentos->departamento}}</td>
                            <td>{{$item->municipio}}</td>
                            <td>
                            <a href="{{route('municipios.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
                            <a href="{{route('municipios.destroy',$item)}}"><i class="material-icons md-18">delete</i></a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $municipios->links() }}     


            </div>                     
        </div>
    </div> 
</div>

@endsection