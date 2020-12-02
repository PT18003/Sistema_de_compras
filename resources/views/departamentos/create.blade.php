@extends('layouts.app')
@section('title','Agregar Departamento')
@section('content')


              {{-- insertamos la ruta que pusimos como nombre. --}}



  <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">            
                    <h1>Agregar Departamento</h1>
                    <p>  <a class="" href="{{route('departamentos.index')}}" role="button">Regresar.</a></p>
                    </div>
                    <form action="{{route('departamentos.guardar')}}" method="POST">
                      @csrf<!-- para crear un token oculto por temas de seguridad  -->
                      <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control" name="departamento" placeholder="Nombre del departamento de El Salvador ">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                    


                </div>                     
            </div>
        </div> 
    </div>  
@endsection

