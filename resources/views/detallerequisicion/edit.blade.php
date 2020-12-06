@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')
<h1>Detalle de mi requisicion</h1>
<x-jet-validation-errors class="mb-4" />
<div class="container">
    <div class="row">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               <div class="container card-body ">            
                    <div class="branding">                 
                    <h1>Editar cantidad y unidades.</h1>
                    <p>  <a class="" href=" {{route('detallerequisiciones.detalle',$requisicion->id)}}" >Regresar.</a></p>
                    </div>
                </div>
                
        <div class="card col-md-4" style="width: 18rem;">
            <img src="{{$detallerequisicion->catalogo->imagen}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$detallerequisicion->catalogo->nombre}}</h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$detallerequisicion->catalogo->descripcion}}</li>
            </ul>
        </div>
            <div class="py-12">
                <form action="{{route('detallerequisiciones.update',$detallerequisicion)}}" method="POST" autocomplete="off">
                    @csrf<!-- para crear un token oculto por temas de seguridad  -->
                    @method('put')
                    <div class="form-group col-md-12">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" type="number" min="1" step="1" class="form-control"  value="{{old('cantidad',$detallerequisicion->cantidad)}}" name="cantidad" placeholder="Cantidad ">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="tipoUnidad">Tipo Unidad</label>
                        <input id="tipoUnidad" type="text" class="form-control"  value="{{old('tipoUnidad',$detallerequisicion->tipoUnidad)}}" name="tipoUnidad" placeholder="tipoUnidad ex. Unidades, decenas, docenas">
                    </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
              </div>
          </div>           
      </div>     
</div> 
@endsection