@extends('layouts.app')
@section('title','Departamentos')
@section('content')


  <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">
                   <h1>Departamentos</h1>
                    <p>  <a class="" href="{{route('departamentos.create')}}" role="button">Agregar.</a></p>
                    </div>   

                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departamentos as $item)
                            <tr>
                            <!---
                                    route('areatrabajos.show',$areatrabajo->id) 
                                    -->
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->departamento}}</td>
                                <td>
                                    <a href="{{route('departamentos.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
                                    {{-- BOTON PARA BORRAR, pero usa un GET --}}
                                    <a href="{{route('departamentos.destroy',$item)}}"><i class="material-icons md-18">delete</i></a>
                                    {{-- BOTON PARA BORRAR, pero usa un POST con el metodo DELETE DEL ROUTE --}}
                                    {{--             
                                    <form action="{{route('departamentos.destroy',$item)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="material-icons md-18">delete</i></button>
                                    </form> 
                                    --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $departamentos->links() }}
                    @endsection               
                  </div>
            </div>
        </div>
    </div>