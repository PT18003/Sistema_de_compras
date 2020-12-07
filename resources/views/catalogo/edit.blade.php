@extends('layouts.app')
@section('title','Modificar Catálogo')

@section('content')


  <div class="py-12"> 
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
               <h1>Modificar Catálogo</h1>
                <p>  <a class="" href="{{route('catalogos.index')}}" role="button">Regresar.</a></p>
                </div>
                <form action="{{route('catalogos.actualizar')}}" enctype="multipart/form-data" method="POST">
                  @csrf<!-- para crear un token oculto por temas de seguridad  -->
                  @method('put')
                    <img class="mx-auto" src="{{$catalogo[0]->imagen}}" alt="" height="150px" width="150px">
                  <div class="form-row m-6">
                      <input type="text" class="form-control" style="display:none" name="id" value="{{$catalogo[0]->id}}">
                  </div>
                  <div class="col m-3">
                      <input type="text" class="form-control" name="nombre" value="{{$catalogo[0]->nombre}}">
                  </div>
                  <div class="col m-3">
                      <input type="text" class="form-control" name="descripcion" value="{{$catalogo[0]->descripcion}}">
                  </div>
                  <div class="container">
                    </div>
                  <div class="col m-3">
                      <input type="file" class="form-control" name="imagen" accept=".png, .jpg, .jpeg">
                  </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>   
@endsection
