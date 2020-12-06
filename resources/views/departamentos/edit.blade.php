@extends('layouts.app')
@section('title','Editar Departamento')
@section('content')

  <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                  <div class="branding">
                    <h1>Editar departamento</h1>
                      <p>  <a class="" href="{{route('departamentos.index')}}" role="button">Regresar.</a></p>
                    </div>
                    <form action="{{route('departamentos.actualizar',$departamento)}}" method="POST" autocomplete="off">
                        @csrf<!-- para crear un token oculto por temas de seguridad  -->
                        @method('put')
                        <div class="form-row">
                          <div class="col">
                          <input type="text" class="form-control" name="departamento" value="{{$departamento->departamento}}" placeholder="Nombre del area de trabajo">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </form>
                </div>                     
            </div>
        </div> 
    </div>

@endsection
