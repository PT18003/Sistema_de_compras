@extends('layouts.app')
@section('title','Reporte Areas de Trabajo')
@section('content')

<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Precios vigentes al: <b><?php
                    	
                   echo date("d/m/Y");
                    ?>
                    </b></h1>
                    <p>  <a class="" href="{{route('dashboard')}}" role="button">Regresar.</a></p>
                </div>
            


        
                
                    <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"class=" d-none">id</th>
                            <th scope="col" class="text-center">Proveedor</th>
                           
                            <th scope="col" class="text-center">Ariculo</th>
                            <th scope="col" class="text-center">Detalles</th>
                        </tr>
                    </thead>
             

                     <tbody>
                     @foreach($proveedores as $item)
                        <tr>
                            <td scope="row" class=" d-none">{{$item->id}}</td>
                            <td class="text-center">{{$item->nombre}} </td>
                            <td class="text-center">
                      
                            @foreach ($precios as $row)
                                @if($item->id == $row->id_proveedor)
                                <div class="card mt-2 mb-4 card-block">
                                        <div class="card-body">
                                    {{$row->Ncatalogo}}
                                    
                                        </div>
                                    </div>
                                @endif
                            @endforeach</td>

                              <td class="text-center">
                      
                            @foreach ($precios as $row)
                                @if($item->id == $row->id_proveedor)
                                <div class="card mt-2 mb-4 card-block">
                                        <div class="card-body">
                                             <span class="badge badge-success"><b>Inicia: </b></span> {{$row->fechaInicio}}
                                             <span class="badge badge-danger"><b>Finalisa: </b></span> {{$row->fechaFinal}}
                                            <b>Precio Unitario: </b> {{$row->precio}}
                                            <b>Descuento: </b> {{$row->descuento}}<b>%</b>
                                    
                                        </div>
                                    </div>
                                @endif
                            @endforeach</td>

                           
                       
                        
                      
                        </tr>
                      @endforeach
                    </tbody>
                </table>   
               
                 <a class="btn btn-info" href="{{route('preciosCPdf')}}">Generar PDF</a> 
            
            </div>
                      
        </div>
    </div> 
</div>  

{{--$suma--}}
@endsection
