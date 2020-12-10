<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AreaTrabajoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\EstadoCivilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ArticulosProveedorController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\RequisicionController;
use App\Http\Controllers\DetalleRequisicionController;
use App\Http\Controllers\RolController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {return view('welcome');})->name('index');
//del dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {return view('dashboard');})->name('dashboard');

/* Se pueden usar el metodo resourse para ahorrar lineas de codigo en una sola 
pero hay que usar las convecciones que laravel nos da v: */



//Roles
Route::get('roles', [RolController::class,'index'])->name('roles.index');
Route::get('roles/create', [RolController::class,'create'])->name('roles.create');
Route::post('roles',[RolController::class,'store'])->name('roles.store');
Route::put('roles/{rol}', [RolController::class,'update'])->name('roles.update');
Route::get('roles/{rol}/edit', [RolController::class,'edit'])->name('roles.edit');
Route::get('roles/delete/{rol}/', [RolController::class,'destroy'])->name('roles.destroy');

/**
* Solo tienen acceso usuarios logueados.
*/
Route::group(['middleware' => 'auth'], function() { 


/**
* Solo tienen acceso usuarios con rol de Administrador.
*/
Route::group(['middleware' => 'admin'], function() {
// agregar todas las rutas referentes al rol de Administrador 
	//ruta para mostrar
Route::middleware(['auth:sanctum', 'verified'])->get('areatrabajos', [AreaTrabajoController::class,'index'])->name('areatrabajos.index');
//ruta para la pagina y para guardar 
Route::middleware(['auth:sanctum', 'verified'])->get('areatrabajos/create', [AreaTrabajoController::class,'create'])->name('areatrabajos.create');
Route::middleware(['auth:sanctum', 'verified'])->post('areastrabajos',  [AreaTrabajoController::class,'guardar'])->name('areatrabajos.guardar');
//ruta para la pagina y para actualizar
Route::middleware(['auth:sanctum', 'verified'])->get('areatrabajos/{id}/edit', [AreaTrabajoController::class,'edit'])->name('areatrabajos.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('areastrabajos/{id}', [AreaTrabajoController::class,'actualizar'])->name('areatrabajos.actualizar');

//enlanzando rutas con las vistas para la tabla Departamento
        //[nombre en la url]              [nombre de la funcion en la clase controller]       [carpeta.nombre]
Route::middleware(['auth:sanctum', 'verified'])->get('departamentos', [DepartamentoController::class,'index'])->name('departamentos.index');
//vista para agregar un departamento
Route::middleware(['auth:sanctum', 'verified'])->get('departamentos/create', [DepartamentoController::class,'create'])->name('departamentos.create');
//no importa si tiene la misma ruta que el index, ya que usa el post, no el get, y en el formulario esta el post
Route::middleware(['auth:sanctum', 'verified'])->post('departamentos', [DepartamentoController::class,'guardar'])->name('departamentos.guardar');
//vitas para editar un departamento
//                         {[nombre de la variable]}
Route::middleware(['auth:sanctum', 'verified'])->get('departamentos/{departamento}/edit', [DepartamentoController::class,'edit'])->name('departamentos.edit');
//creando la ruta para el formulario de editar con put(es mejor usarlo, segun laravel)
Route::middleware(['auth:sanctum', 'verified'])->put('departamentos/{departamento}', [DepartamentoController::class,'actualizar'])->name('departamentos.actualizar');
//usando metodo delete para eliminar, la url puede ser iguala la de un get, put
//Route::middleware(['auth:sanctum', 'verified'])->delete('departamentos/{departamento}', [DepartamentoController::class,'destroy'])->name('departamentos.destroy');
//Usando metodo get, para eliminar, la url tiene que ser diferente. 
Route::middleware(['auth:sanctum', 'verified'])->get('departamentos/delete/{departamento}/', [DepartamentoController::class,'destroy'])->name('departamentos.destroy');

//municipios
Route::middleware(['auth:sanctum', 'verified'])->get('municipios', [MunicipioController::class,'index'])->name('municipios.index');
Route::middleware(['auth:sanctum', 'verified'])->get('municipios/create',  [MunicipioController::class,'create'])->name('municipios.create');
Route::middleware(['auth:sanctum', 'verified'])->post('municipios', [MunicipioController::class,'guardar'])->name('municipios.guardar');
Route::middleware(['auth:sanctum', 'verified'])->get('municipios/{municipio}/edit', [MunicipioController::class,'edit'])->name('municipios.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('municipios/{municipio}', [MunicipioController::class,'actualizar'])->name('municipios.actualizar');
Route::middleware(['auth:sanctum', 'verified'])->get('municipios/delete/{municipio}/', [MunicipioController::class,'destroy'])->name('municipios.destroy');

//genero
Route::middleware(['auth:sanctum', 'verified'])->get('generos', [GeneroController::class,'index'])->name('generos.index');
Route::middleware(['auth:sanctum', 'verified'])->get('generos/create',  [GeneroController::class,'create'])->name('generos.create');
Route::middleware(['auth:sanctum', 'verified'])->post('generos', [GeneroController::class,'guardar'])->name('generos.guardar');
Route::middleware(['auth:sanctum', 'verified'])->get('generos/{genero}/edit', [GeneroController::class,'edit'])->name('generos.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('generos/{genero}', [GeneroController::class,'actualizar'])->name('generos.actualizar');
Route::middleware(['auth:sanctum', 'verified'])->get('generos/delete/{genero}/', [GeneroController::class,'destroy'])->name('generos.destroy');
//estadocovil
Route::middleware(['auth:sanctum', 'verified'])->get('estadosciviles', [EstadoCivilController::class,'index'])->name('estadosciviles.index');
Route::middleware(['auth:sanctum', 'verified'])->get('estadosciviles/create',  [EstadoCivilController::class,'create'])->name('estadosciviles.create');
Route::middleware(['auth:sanctum', 'verified'])->post('estadosciviles', [EstadoCivilController::class,'guardar'])->name('estadosciviles.guardar');
Route::middleware(['auth:sanctum', 'verified'])->get('estadosciviles/{estadocivil}/edit', [EstadoCivilController::class,'edit'])->name('estadosciviles.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('estadosciviles/{estadocivil}', [EstadoCivilController::class,'actualizar'])->name('estadosciviles.actualizar');
Route::middleware(['auth:sanctum', 'verified'])->get('estadosciviles/delete/{estadocivil}/', [EstadoCivilController::class,'destroy'])->name('estadosciviles.destroy');

//Roles
Route::get('roles', [RolController::class,'index'])->name('roles.index');
Route::get('roles/create', [RolController::class,'create'])->name('roles.create');
Route::post('roles',[RolController::class,'store'])->name('roles.store');
Route::put('roles/{rol}', [RolController::class,'update'])->name('roles.update');
Route::get('roles/{rol}/edit', [RolController::class,'edit'])->name('roles.edit');
Route::get('roles/delete/{rol}/', [RolController::class,'destroy'])->name('roles.destroy');

    });

/**
* Solo tienen acceso usuarios con rol de Empleado.
*/
Route::group(['middleware' => 'emple'], function() {
// agregar todas las rutas referentes al rol de Empleado 
//empleados
Route::middleware(['auth:sanctum', 'verified'])->get('empleados', [EmpleadoController::class,'index'])->name('empleados.index');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/create', [EmpleadoController::class,'create'])->name('empleados.create');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/towns/{id}',[EmpleadoController::class,'getTowns'])->name('empleados.getTowns');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/etowns/{empleado}',[EmpleadoController::class,'geteTowns'])->name('empleados.geteTowns');
Route::middleware(['auth:sanctum', 'verified'])->post('empleados',[EmpleadoController::class,'guardar'])->name('empleados.guardar');
Route::middleware(['auth:sanctum', 'verified'])->put('empleados/{empleado}', [EmpleadoController::class,'actualizar'])->name('empleados.actualizar');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/{empleado}/edit', [EmpleadoController::class,'edit'])->name('empleados.edit');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/delete/{empleado}/', [EmpleadoController::class,'destroy'])->name('empleados.destroy');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/view/{empleado}', [EmpleadoController::class,'view'])->name('empleados.view');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/registro/{empleado}', [UsuarioController::class,'createIndex'])->name('registro');
Route::middleware(['auth:sanctum', 'verified'])->get('empleados/cambio/{empleado}', [UsuarioController::class,'editIndex'])->name('cambio');

Route::middleware(['auth:sanctum', 'verified'])->post('empleados/registrar',  [UsuarioController::class,'create'])->name('registrar');
Route::middleware(['auth:sanctum', 'verified'])->post('empleados/editar',  [UsuarioController::class,'edit'])->name('editar');
//proveedores
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores', [ProveedorController::class,'index'])->name('proveedores.index');
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores/create', [ProveedorController::class,'create'])->name('proveedores.create');
Route::middleware(['auth:sanctum', 'verified'])->post('proveedores',[ProveedorController::class,'store'])->name('proveedores.store');
Route::middleware(['auth:sanctum', 'verified'])->put('proveedores/{proveedor}', [ProveedorController::class,'update'])->name('proveedores.update');
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores/{proveedor}/edit', [ProveedorController::class,'edit'])->name('proveedores.edit');
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores/delete/{proveedor}/', [ProveedorController::class,'destroy'])->name('proveedores.destroy');


//Articulos_Proveedores
Route::middleware(['auth:sanctum', 'verified'])->get('articulosProveedores', [ArticulosProveedorController::class,'index'])->name('articulosProveedores.index');
Route::middleware(['auth:sanctum', 'verified'])->get('articulosProveedores/create', [ArticulosProveedorController::class,'create'])->name('articulosProveedores.create');
Route::middleware(['auth:sanctum', 'verified'])->post('articulosProveedores',[ArticulosProveedorController::class,'store'])->name('articulosProveedores.store');
Route::middleware(['auth:sanctum', 'verified'])->put('articulosProveedores/{articuloProveedor}', [ArticulosProveedorController::class,'update'])->name('articulosProveedores.update');
Route::middleware(['auth:sanctum', 'verified'])->get('articulosProveedores/{articuloProveedor}/edit', [ArticulosProveedorController::class,'edit'])->name('articulosProveedores.edit');
Route::middleware(['auth:sanctum', 'verified'])->get('articulosProveedores/delete/{articuloProveedor}/', [ArticulosProveedorController::class,'destroy'])->name('articulosProveedores.destroy');

//prueba ajax ignorar
Route::middleware(['auth:sanctum', 'verified'])->get('/departamentos/fetch_data', [DepartamentoController::class,'fetch_data'])->name('departamentos.get_data');
Route::middleware(['auth:sanctum', 'verified'])->post('/departamentos/add_data', [DepartamentoController::class,'add_data'])->name('departamentos.add_data');
Route::middleware(['auth:sanctum', 'verified'])->post('/departamentos/update_data', [DepartamentoController::class,'update_data'])->name('departamentos.update_data');
Route::middleware(['auth:sanctum', 'verified'])->post('/departamentos/delete_data', [DepartamentoController::class,'delete_data'])->name('departamentos.delete_data');
//Articulos_Proveedores 
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores/{proveedor}/articulosProveedores', [ArticulosProveedorController::class,'index'])->name('articulosProveedores.index');//mostrar articulos 
Route::middleware(['auth:sanctum', 'verified'])->put('proveedores/{proveedor}/articulosProveedores',[ArticulosProveedorController::class,'store'])->name('articulosProveedores.store');//agregar articulos
Route::middleware(['auth:sanctum', 'verified'])->put('proveedores/articulosProveedores/{articuloProveedor}', [ArticulosProveedorController::class,'update'])->name('articulosProveedores.update');//formulario editar
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores/articulosProveedores/{articuloProveedor}/edit', [ArticulosProveedorController::class,'edit'])->name('articulosProveedores.edit');//vista de editar
Route::middleware(['auth:sanctum', 'verified'])->get('proveedores/articulosProveedores/delete/{articuloProveedor}/', [ArticulosProveedorController::class,'destroy'])->name('articulosProveedores.destroy');

//CATALOGO
Route::middleware(['auth:sanctum', 'verified'])->get('catalogos', [CatalogoController::class,'index'])->name('catalogos.index');//usa
Route::middleware(['auth:sanctum', 'verified'])->get('catalogos/create', [CatalogoController::class,'create'])->name('catalogos.create');//usa
Route::middleware(['auth:sanctum', 'verified'])->post('catalogos/create',[CatalogoController::class,'guardar'])->name('catalogos.guardar');
Route::middleware(['auth:sanctum', 'verified'])->get('catalogos/{catalogo}/edit', [CatalogoController::class,'edit'])->name('catalogos.edit');
Route::middleware(['auth:sanctum', 'verified'])->get('catalogos/delete/{catalogo}/', [CatalogoController::class,'destroy'])->name('catalogos.destroy');
Route::middleware(['auth:sanctum', 'verified'])->get('catalogos/view/{catalogo}', [CatalogoController::class,'view'])->name('catalogos.view');
Route::middleware(['auth:sanctum', 'verified'])->put('catalogos/edit', [CatalogoController::class, 'actualizar'])->name('catalogos.actualizar');

//pdf
Route::middleware(['auth:sanctum', 'verified'])->get('empleados-list-pdf', [EmpleadoController::class,'exportPdf'])->name('empleados.pdf');
Route::middleware(['auth:sanctum', 'verified'])->get('doc', [EmpleadoController::class,'doc'])->name('doc');
Route::middleware(['auth:sanctum', 'verified'])->post('catalogos/edit', [CatalogoController::class, 'actualizar'])->name('catalogos.actualizar');
//REQUISICION

Route::middleware(['auth:sanctum', 'verified'])->get('requisiciones', [RequisicionController::class,'index'])->name('requisiciones.index');
Route::middleware(['auth:sanctum', 'verified'])->post('requisiciones', [RequisicionController::class,'create'])->name('requisiciones.create');
Route::middleware(['auth:sanctum', 'verified'])->put('requisiciones/{requisicion}/detalle/send', [RequisicionController::class,'send'])->name('requisiciones.send');
Route::middleware(['auth:sanctum', 'verified'])->put('requisiciones/{requisicion}/detalle/aceptar', [RequisicionController::class,'aceptar'])->name('requisiciones.aceptar');
Route::middleware(['auth:sanctum', 'verified'])->put('requisiciones/{requisicion}/detalle/demegar', [RequisicionController::class,'denegar'])->name('requisiciones.denegar');
Route::middleware(['auth:sanctum', 'verified'])->put('requisiciones/{requisicion}/ordenar', [RequisicionController::class,'ordenar'])->name('requisiciones.ordenar');

//detalle requisicion
Route::middleware(['auth:sanctum', 'verified'])->get('requisiciones/{requisicion}/agregar', [DetalleRequisicionController::class,'index'])->name('detallerequisiciones.index');
Route::middleware(['auth:sanctum', 'verified'])->post('requisiciones/{requisicion}/agregar',[DetalleRequisicionController::class,'store'])->name('detallerequisiciones.store');//agregar a la requisicion
Route::middleware(['auth:sanctum', 'verified'])->get('requisiciones/{requisicion}/detalle',[DetalleRequisicionController::class,'detalle'])->name('detallerequisiciones.detalle');
Route::middleware(['auth:sanctum', 'verified'])->get('requisiciones/{requisicion}/detalle/{detallerequisicion}',[DetalleRequisicionController::class,'edit'])->name('detallerequisiciones.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('requisiciones/detallerequisicion/actualizar/{detallerequisicion}', [DetalleRequisicionController::class,'update'])->name('detallerequisiciones.update');
Route::middleware(['auth:sanctum', 'verified'])->get('requisiciones/detallerequisicion/destroy/{detallerequisicion}',[DetalleRequisicionController::class,'destroy'])->name('detallerequisiciones.destroy');
Route::middleware(['auth:sanctum', 'verified'])->get('requisiciones/{requisicion}/detalle/{detallerequisicion}/agregararticulo',[DetalleRequisicionController::class,'agregararticulo'])->name('detallerequisiciones.agregararticulo');
Route::middleware(['auth:sanctum', 'verified'])->put('requisiciones/requisicion/detalle/{detallerequisicion}/agregararticulo/{articuloproveedor}',[DetalleRequisicionController::class,'agregararticuloproveedor'])->name('detallerequisiciones.agregararticuloproveedor');

    });

});
