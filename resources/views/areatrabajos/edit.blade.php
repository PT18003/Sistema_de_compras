@extends('layouts.app')
@section('title','Editar Area de Trabajo')
@section('content')


    <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div class="container card-body ">            
                    <div class="branding">                 
                    <h1>Editar area de trabajo</h1>
                    <p>  <a class="" href=" {{route('areatrabajos.index')}}" >Regresar.</a></p>
                    </div>


                    <form action="{{route('areatrabajos.actualizar',$id)}}" method="POST" autocomplete="off">
                        @csrf<!-- para crear un token oculto por temas de seguridad  -->
                        @method('put')
                        <div class="form-row">
                          <div class="col">
                          <input type="text" class="form-control" name="nombreDep" value="{{$id->nombreDep}}" placeholder="Nombre del area de trabajo">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </form>
                    @endsection
                  </div>
              </div>
          </div>           
      </div>                                
