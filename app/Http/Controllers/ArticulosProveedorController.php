<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use App\Models\ArticulosProveedor;
use App\Models\Catalogo;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Proveedor; 

class ArticulosProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Proveedor $proveedor)//metodo para cargar los articulos de provedores. 
    {
        $provee=Proveedor::find($proveedor->id)->catalogo;
        $catalogo = Catalogo::all();
        $catalogo1 = $catalogo->diff($provee);
        $articulosProveedores = ArticulosProveedor::where('id_proveedor',$proveedor->id)->get();
        //return $provee;
        return view('articulosProveedores.index',compact('catalogo','proveedor','articulosProveedores'));  
    }
    public function create()
    {
        $inventarios = Inventario::all();
        $proveedores= Proveedor::all();
        return view('articulosProveedores.create')
        -> with('inventarios',$inventarios)
        -> with('proveedores', $proveedores);
    }
/*
    public function index(Proveedor $proveedor)//metodo para cargar los articulos de provedores. 
    {
        $provee=Proveedor::find($proveedor->id)->catalogo;
        $catalogo = Catalogo::all();
        $catalogo1 = $catalogo->diff($provee);
        $articulosProveedores = ArticulosProveedor::where('id_proveedor',$proveedor->id)->get();
        //return $provee;
        return view('articulosProveedores.index',compact('catalogo','proveedor','articulosProveedores'));  
    }*/
    public function store(Request $request, Proveedor $proveedor) //metodo para agregar catalogo a articulos proveedores
    {
        $validatedData = $request->validate([
            
            'catalogo' => 'required|exists:catalogos,id',
        ]);
        $provee=Proveedor::find($proveedor->id)->catalogo;
        $catalogos = $request->input('catalogo');
        $arrayProvee =[];
        $contador =0;
        foreach($provee as $item)
        {
            $arrayProvee[$contador] =$item->id;
            $contador=1+$contador;
            
        }
        $resultado = array_diff($catalogos,$arrayProvee);
        $proveedor->catalogo()->attach($catalogos);
        return redirect()->route('articulosProveedores.index',[$proveedor->id]);
    }
    public function edit(ArticulosProveedor $articuloProveedor)
    {
        return view('articulosProveedores.edit',compact('articuloProveedor'));
    }
    public function update(Request $request, ArticulosProveedor $articuloProveedor)
    {
        $validatedData = $request->validate([
            'codigoArticulo' =>'required',
            'fechaInicio'=>'required|date|after:yesterday',
            'fechaFinal'=>'required|date|after:fechaInicio',
            'precio'=>'required|numeric|between:0,9999.99|regex:/^\d{1,3}(?:\d\d\d)*(?:.\d{1,2})?$/',
            'descuento'=>'required|numeric|between:0,9999.99|regex:/^\d{1,3}(?:\d\d\d)*(?:.\d{1,2})?$/',
            
        ]);
        $articuloProveedor->codigoArticulo = $request->codigoArticulo;
        $articuloProveedor->fechaInicio=$request->fechaInicio;
        $articuloProveedor->fechaFinal=$request->fechaFinal;
        $articuloProveedor->precio=$request->precio;
        $articuloProveedor->descuento=$request->descuento;   
        $articuloProveedor->save();

        return redirect()->route('articulosProveedores.index',[$articuloProveedor->id_proveedor]);
    }
    public function destroy(ArticulosProveedor $articuloProveedor)
    {
        $articuloProveedor->delete();
        return redirect()->route('articulosProveedores.index',[$articuloProveedor->id_proveedor]);
    }

}
