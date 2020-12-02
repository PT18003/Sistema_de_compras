@extends('layouts.app')
@section('title','Editar Genero')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Editar genero</h1>
                    <p>  <a class="" href="{{route('generos.index')}}" role="button">Regresar.</a></p>
                </div>
                <form action="{{route('generos.actualizar',$genero)}}" method="POST" autocomplete="off">
                  @csrf<!-- para crear un token oculto por temas de seguridad  -->
                  @method('put')
                  <div class="form-row">
                      <div class="col-md-4">
                          <label for="genero">Genero</label>
                          <input id="genero" type="text" class="form-control" name="genero" value="{{$genero->genero}}" placeholder="Genero">
                        </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>


            </div>                     
        </div>
    </div> 
</div>  
@endsection
