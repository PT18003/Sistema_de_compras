@extends('layouts.app')
@section('title','Dashboard')
@section('content')
       
<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1>Bienvenido <b>{{ Auth::user()->name }}</b></h1>
                    <a href="{{route('empleados.pdf')}}">Puede descargar una lista de los empleados <b> AQUI</b> </a>
                
                </div>   


            </div>                     
        </div>
    </div> 
</div>
@endsection  
