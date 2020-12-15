@extends('layouts.app')
@section('title','Dashboard')
@section('content')
       
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css">
<div class="py-12">  
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body ">                  
                <div class="branding">
                    <h1 class="mt-4 text-center">Bienvenido <b>{{ Auth::user()->name }}</b></h1>
                    <a href="{{route('empleados.pdf')}}">Puede descargar una lista de los empleados <b> AQUI</b> </a>
                
                </div>
             
               
                <div class="row">
                  
                    {{--ordenes--}}
                     <div class="col-xl-4 col-md-6 pt-3 pb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center flex-nowrap">
                                <div class="col">
                                    <h4 class="font-weight-light mb-0 text-truncate">Ordenes</h4>
                                </div>
                                <div class="col-auto ml-auto px-2">
                                    <button data-target="#contentSlider1" data-slide="prev" class="btn btn-outline-info rounded-pill btn-sm py-0"><span aria-hidden="true" class="mdi mdi-24px mdi-chevron-left align-middle"></span><span class="sr-only">Previous</span></button>
                                    <button data-target="#contentSlider1" data-slide="next" class="btn btn-outline-info rounded-pill btn-sm py-0 ml-2"><span aria-hidden="true" class="mdi mdi-24px mdi-chevron-right align-middle"></span><span class="sr-only">Next</span></button>
                                </div>
                            </div>
                        </div>
                        <div id="contentSlider1" data-ride="carousel" data-interval="4000" class="carousel slide my-auto pointer-event">
                            <div role="listbox" class="carousel-inner rounded-lg">
                                
                               <?php   $valor = 0; ?>
                                 @foreach ($join as $row)
                                                                     
                                    <?php 
                                    $monto = 0;
                                    $suma = 0; 
                                    $creada = null;
                                    $proveedor = null;
                                  
                                    ?>
                                    @foreach($ordenes as $orden)                                             
                                        @if($orden->ordenCompra == $row->ordenCompra)
                                            <?php
                                            $suma = $suma + $orden->cantidad;                                               
                                            $monto = $monto + (round((((100-$orden->articuloProveedor['descuento'])/100)*$orden->articuloProveedor['precio'])*($orden->cantidad),4));
                                            $creada = $orden->created_at;
                                            $proveedor = $orden->articuloProveedor->proveedor->nombre;
                                            $direccion = $orden->articuloProveedor->proveedor->direccion;
                                            $depto = $orden->articuloProveedor->proveedor->municipio->departamentos->departamento;
                                            $muni =  $orden->articuloProveedor->proveedor->municipio->municipio;
                                            ?>
                                        @endif                                            
                                    @endforeach
                                      
                                    @if($valor == 0)
                                        <div class="carousel-item active">
                                         <?php 
                                        $valor = 1;
                                        ?>
                                    
                                    @else
                                          <div class="carousel-item">
                                    @endif

                                  
                                        <div class="card bg-transparent border-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <div class="card-body text-truncate">
                                                        <h4 class="mb-0 text-info font-weight-light"> {{$proveedor}}  </h4>
                                                        <p class="mt-1">{{$depto}}, {{$muni}}, <br> {{$direccion}}</p>
                                                        <p class="mt-1">Orden compra: {{$row->ordenCompra}}</p>
                                                        <h3 class="mb-0">$  {{$monto}} <i class="mdi mdi-36px mdi-paypal float-right"></i></h3>
                                                        <p>Total Articulos:   {{$suma}}</p>
                                                        <span class="text-right"><a class=" badge bg-success text-light text-right" href="{{route('detallerequisiciones.detalle',$row->rid)}}">Consultar requisicion</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                    {{--fin ordenes--}}
            
                  <div class="col-xl-4 col-md-6 pb-2">
                        <div class="card  p-0  shadow-sm">
                            <div class="row h-100 no-gutters rounded flex-nowrap">
                                <div class="col-auto bg-danger rounded-left">&nbsp;</div>
                                <div class="col p-3 py-4 text-danger">
                                    <h6 class="text-truncate text-uppercase">Salidas</h6>
                                    <h3>53</h3>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 pb-2">
                        <div class="card  p-0  shadow-sm">
                            <div class="row h-100 no-gutters rounded flex-nowrap">
                                <div class="col-auto bg-success rounded-left">&nbsp;</div>
                                <div class="col p-3 py-4 text-success">
                                    <h6 class="text-truncate text-uppercase">Entradas</h6>
                                    <h3>53</h3>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
                   <a href="{{route('correoProveedor')}}">Prueba Correo</a>
            </div>                     
        </div>
    </div> 
 
</div>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container card-body "> 
            <h2 class="mt-4 mb-4">Area de reportes.</h2>
          
              <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats h-100">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="mdi  mdi-36px mdi-credit-card-outline float-right"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Empleados</p>
                                                <h4 class="card-title">{{$countempleados}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                     <hr>
                                    <div class="stats">
                                         <i class="mdi mdi-credit-card-outline float-right"></i><a href="{{route('artempleados')}}">Articulos solicitados por empleados.</a>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats h-100">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">
                                                  <i class="mdi  mdi-36px mdi-credit-card-outline float-right"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Areas</p>
                                                <h4 class="card-title"> {{$countareas}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                     <hr>
                                    <div class="stats">
                                         <i class="mdi mdi-credit-card-outline float-right"></i> <a href="{{route('artareas')}}">Articulos solicitados por areas de trabajo.</a>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats h-100">
                                <div class="card-body  ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="nc-icon nc-vector text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Proveedores</p>
                                                <h4 class="card-title">{{$countproveedores}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                      <hr>
                                      
                                    <div class="stats">
                                    <ul>
                                    <li>
                                        <i class="fa fa-clock-o"></i> <a href="{{route('proveedorC')}}">Pedidos por proveedores</a>
                                        </li>
                                        <li> <i class="mdi  mdi-credit-card-outline float-right"></i> <a href="{{route('preciosC')}}">Precios vigentes</a></li>
                                    </ul>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats  h-100">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">
                                                <i class="mdi mdi-36px mdi-credit-card-outline float-right"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category">Articulos</p>
                                                <h4 class="card-title">{{$countarticulos}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="stats">
                                    <ul>
                                    
                                    <li> <i class="mdi  mdi-credit-card-outline float-right"></i> <a href="">[Falta] Stock de iventario</a></li>
                                    <li> <i class="mdi  mdi-credit-card-outline float-right"></i> <a href="">[Falta] Reporte de Inventario</a></li>
                                     
                                     

                                    </ul>
                                       
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>                 
            </div>
        </div>
</div>
@endsection  
