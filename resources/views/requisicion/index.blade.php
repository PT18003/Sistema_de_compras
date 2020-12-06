@extends('layouts.app')
@section('title','requisicones')
@section('content')

<div class="container">
    <div class="row">
        <h1>Requisiciones de productos</h1>
        <form method="post" action="{{route('requisiciones.index')}}" enctype="multipart/form-data">
            @csrf
            <button type="submit" class="btn btn-primary">Crear una Requisicion</button>
        </form>
        @if ($mensajeError != NULL)
            <p>{{$mensajeError}}</p>
        @endif
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


@endsection
