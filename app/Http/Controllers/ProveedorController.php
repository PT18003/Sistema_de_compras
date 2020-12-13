<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Proveedor; 
use App\Models\Departamento;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::paginate(7);

        return view('proveedores.index')
            ->with('proveedores',$proveedores);
    }
    public function create()
    {
        $departamentos = Departamento::all();
        $municipios= Municipio::all();
        return view('proveedores.create')
        -> with('municipios',$municipios)
        -> with('departamentos', $departamentos);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' =>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
            'montoMin'=>'required|numeric|between:0,9999.99|regex:/^\d{1,3}(?:\d\d\d)*(?:.\d{1,2})?$/',
            'tiempoEntrega'=>'required|numeric|between:0,365|',
            'periodoPago'=>'required|numeric|between:0,365|',
            'municipio'=>'required|exists:Municipio,id',
            'departamento'=>'required|exists:Departamento,id'
        ]);
        $proveedor = new Proveedor();
        $proveedor->nombre=$request->nombre;
        $proveedor->municipio_id=$request->municipio;
        $proveedor->direccion=$request->direccion;
        $proveedor->telefono=$request->telefono;
        $proveedor->correo=$request->correo;
        $proveedor->nit=$request->nit;
        $proveedor->montoMin=$request->montoMin;
        $proveedor->tiempoEntrega=$request->tiempoEntrega;
        $proveedor->periodoPago=$request->periodoPago;
        $proveedor->save();
        
        return redirect()->route('proveedores.index');
    }
    public function edit($id)
    {
        $departamentos= Departamento::all();
        $municipios= Municipio::all();
        $proveedor = Proveedor::find($id); 
        return view('proveedores.edit')
        -> with('municipios',$municipios)
        -> with('proveedor',$proveedor)
        -> with('departamentos', $departamentos);
    }
    public function update(Request $request, Proveedor $proveedor)
    {
        $validatedData = $request->validate([
            'nombre' =>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
            'montoMin'=>'required|numeric|between:0,9999.99|regex:/^\d{1,3}(?:\d\d\d)*(?:.\d{1,2})?$/',
            'tiempoEntrega'=>'required|numeric|between:0,365|',
            'periodoPago'=>'required|numeric|between:0,365|',
            'municipio'=>'exists:municipio,id',
            'departamento'=>'exists:departamento,id'
        ]);
        //$proveedor = Proveedor::find($id);
        $proveedor->nombre=$request->nombre;
        $proveedor->municipio_id=$request->municipio;
        $proveedor->direccion=$request->direccion;
        $proveedor->telefono=$request->telefono;
        $proveedor->correo=$request->correo;
        $proveedor->nit=$request->nit;
        $proveedor->montoMin=$request->montoMin;
        $proveedor->tiempoEntrega=$request->tiempoEntrega;
        $proveedor->periodoPago=$request->periodoPago;
        $proveedor->save();

        return redirect()->route('proveedores.index');
    }
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index');
    }
}
