@extends('layouts.app')
@section('title','Articulos de proveedores')
@section('content')


<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-jet-validation-errors class="mb-4" />
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Detalle de mi requisicion</h1>
                    <p>  <a class="" href="{{route('requisiciones.index')}}" role="button">Regresar.</a></p>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Catalogo de Productos</h3>
                            </div>
                            <div class=" card-body">
                                <form method="post" action="{{route('detallerequisiciones.store',$requisicion)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row row-cols-1 row-cols-md-3">
                                        @foreach ($catalogo1 as $item)
                                        <div class="col mb-4">
                                            <div class="card">
                                                <div class="card h-100">
                                                    <img src="{{$item->imagen}}" height="100px" width="100px" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$item->nombre}}</h5>
                                                        <p class="card-text">{{$item->descripcion}}</p>
                                                                       
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="catalogo[]" value="{{ $item->id }}"  id="defaultCheck1">
                                                            <label class="form-check-label" for="defaultCheck2">
                                                                Seleccionar
                                                                </label>
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if ($requisicion->estado_req==0)
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                    @else
                                        
                                    @endif
                                    
                                </form>  
                            </div>
                        </div>
                    </div>
                    <div class="col">    
                        <div class="card">
                            <div class="card-header">
                                <h3>Productos Agregados a la requisicion</h3>
                            </div>
                            <div class=" card-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($detalleRequisicion as $item)
                                        <li class="list-group-item">{{$item->catalogo->nombre}}</li>
                                    @endforeach
                                </ul>
                                <a class="btn btn-primary" href="{{route('detallerequisiciones.detalle',$requisicion)}}" role="button">Mostrar mas detalles</a>
                            </div>
                        </div>
                    </div>    

                    
                </div>

            </div>                     
        </div>
    </div> 
</div>   
@endsection