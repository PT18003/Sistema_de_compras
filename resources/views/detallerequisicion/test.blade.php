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
                
                </div>
                {{array_keys($porProveedores)}}
                @foreach ($porProveedores as $a)
                    
                @endforeach

            </div>                     
        </div>
    </div> 
</div>   
@endsection