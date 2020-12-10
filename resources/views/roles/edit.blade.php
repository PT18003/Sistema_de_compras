@extends('layouts.app')
@section('title','Editar Rol')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                  <h1>Editar Rol</h1>
                    <p>  <a class="" href="{{route('roles.index')}}" role="button">Regresar.</a></p>
                </div>


                <div class="container">
                    <form action="{{route('roles.update',$rol)}}" method="POST" autocomplete="off">
                        @csrf<!-- para crear un token oculto por temas de seguridad  -->
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                            <input id="nombre" type="text" class="form-control" value="{{$rol->nombre}}" name="nombre" placeholder="Nombre ">
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="descripcion">Descripcion</label>
                                <input id="descripcion" type="text" class="form-control"  value="{{$rol->descripcion}}"name="descripcion" placeholder="descripcion">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection