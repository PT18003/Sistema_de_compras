<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requisicion;
use App\Models\Catalogo;
use Illuminate\Http\Request;
use App\Models\DetalleRequisicion;

class DetalleRequisicionController extends Controller
{
    public function index(Requisicion $requisicion)
    {
       
        $requi = Requisicion::find($requisicion->id)->catalogo;
        $catalogo = Catalogo::all();
        $catalogo1 = $catalogo->diff($requi);
        $detalleRequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
        return view('detallerequisicion.index',compact('catalogo1','requisicion','detalleRequisicion'));
    }
    public function store(Request $request, Requisicion $requisicion) //metodo para agregar catalogo a la requisicion
    {
        $validatedData = $request->validate([
            
            'catalogo' => 'required|exists:catalogos,id',
        ]);
        $provee=Requisicion::find($requisicion->id)->catalogo;
        $catalogos = $request->input('catalogo');
        $arrayProvee =[];
        $contador =0;
        foreach($provee as $item)
        {
            $arrayProvee[$contador] =$item->id;
            $contador=1+$contador;
        }
        $resultado = array_diff($catalogos,$arrayProvee);
        $requisicion->catalogo()->attach($resultado);
        return redirect()->route('detallerequisiciones.index',[$requisicion->id]);
    }
    public function detalle(Requisicion $requisicion)
    {
        $detalleRequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
        $cuentadetalle = DetalleRequisicion::where('requisicion_id',$requisicion->id)->count();
        $cont =0;
        foreach ($detalleRequisicion as $item)
        {
            if($item->cantidad == NULL || $item->tipoUnidad == NULL)
            {
               
            }
            else
            {
                $cont=1+$cont;
            }
        }
        if($cont==$cuentadetalle)
        {
            $permiso=1;
        }
        else
        {
            $permiso=0;
        }
        return view('detallerequisicion.detalle', compact('detalleRequisicion','permiso','requisicion'));
    }
    public function edit(Requisicion $requisicion, DetalleRequisicion $detallerequisicion)
    {
       return view('detallerequisicion.edit',compact('detallerequisicion', 'requisicion'));
    }
    public function update(Request $request, DetalleRequisicion $detallerequisicion)
    {

        $validatedData = $request->validate([
            'tipoUnidad' =>'required|string',
            'cantidad'=>'required|numeric|between:0,10000',
            
        ]);
        $detallerequisicion->cantidad=$request->cantidad;
        $detallerequisicion->tipoUnidad=$request->tipoUnidad;
        $detallerequisicion->save();
        return redirect()->route('detallerequisiciones.detalle',[$detallerequisicion->requisicion_id ]);
    }
    public function destroy(DetalleRequisicion $detallerequisicion)
    {
        $detallerequisicion->delete();
        return redirect()->route('detallerequisiciones.detalle',[$detallerequisicion->requisicion_id ]);
    }

}
