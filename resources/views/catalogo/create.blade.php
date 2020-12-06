@extends('layouts.app')
@section('title','Agregar Catálogo')

@section('content')



<div class="py-12"> 
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
              <h1>Agregar Catálogo</h1>
                <p>  <a class="" href="{{route('catalogos.index')}}" role="button">Regresar.</a></p>
                </div>
                <form action="{{route('catalogos.guardar')}}" enctype="multipart/form-data" method="POST">
                  @csrf
                      @csrf<!-- para crear un token oculto por temas de seguridad  -->
                      <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre del producto">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripcion del producto">
                        </div>
                        <div class="col">
                          <input type="file" class="form-control" name="imagen" accept=".png, .jpg, .jpeg">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>

            </div>
        </div>
    </div>
</div>   
@endsection