@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')


<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />
            <div class="container card-body ">                  
                <div class="branding">
                     <h1>Editar cantidad y unidades.</h1>
                     
                    <p>  <a class="" href="{{route('detallerequisiciones.detalle',$requisicion)}}" role="button"><h6>Detalle de mi requisicion</h6></a></p>
                    
                </div>
                <div class="row">
                    <div class="card col-3">
                        <img src="{{$detallerequisicion->catalogo->imagen}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$detallerequisicion->catalogo->nombre}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$detallerequisicion->catalogo->descripcion}}</li>
                        </ul>
                    </div>
                    <div class="col">
                        <div class=" form-group card col">
                            <h4 class="mt-3 col-md-12">Cantidad y unidades</h4>
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
                                <div class="form-group col-md-12">
                                     <button type="submit" class="btn btn-primary">Guardar</button>
                                
                                </div>
                                   
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>           
    </div>     
</div> 
@endsection