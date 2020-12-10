@extends('layouts.app')
@section('title','Requisiciones')
@section('content')

<div class="py-12"> 
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if ($mensajeError != NULL)

                <div class="bg-white  sm:rounded-lg">
                <div  class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"> 
        
                    {{ __('Whoops! Parece que algo salio mal.') }}
                    !</h4>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        {{$mensajeError}}
                    </ul>
                </div>
                            
            </div>
            @endif
        
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Requisiciones de productos</h1>
                    <p>
                    <form method="post" action="{{route('requisiciones.index')}}" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-primary">Crear una Requisicion</button>
                    </form>
                    </p>
                </div>
                <div class="container">
                    <div class="row">      
                        <table class="table">
                            <caption>Requisiciones</caption>
                            <thead> 
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Fecha Creada</th>
                                <th scope="col">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($requisiciones as $item)
                            <tr>
                                
                                    <td>{{$item->id}}</td>
                                    <td>{{date_format($item->created_at,'l,d M, Y  H:i:s')}}</td>

                                    <td>
                                        @if ($item->estado_req==0)
                                    <a href="{{route('detallerequisiciones.index',$item->id)}}" class="badge badge-secondary">No enviada</a>
                                        @else
                                            @if ($item->estado_req==1)
                                                <a href="{{route('detallerequisiciones.detalle',$item->id)}}" class="badge badge-info">Enviada</a>
                                            @else
                                                
                                            @endif
                                        @endif
                                    </td>
                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>   



@endsection
