<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requisicion;
use App\Models\Catalogo;
use App\Models\ArticulosProveedor;
use Illuminate\Http\Request;
use App\Models\DetalleRequisicion;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

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
        $empleado = Auth::user()->empleado_id;
        $empleadobuscar = Empleado::find($empleado)->areatrabajo_id;
        if($empleadobuscar==3)
        {
            $acceso =3;
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
            return view('detallerequisicion.detalle', compact('detalleRequisicion','permiso','requisicion','acceso'));
    
        }
        else
        {
            if($empleadobuscar==2)
            {
                $acceso=2;
                $detalleRequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
                $cuentadetalle = DetalleRequisicion::where('requisicion_id',$requisicion->id)->count();
                $cont =0;
                foreach ($detalleRequisicion as $item)
                {
                    if($item->id_articuloProveedor == NULL)
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
                //return $detalleRequisicion;
                return view('detallerequisicion.detalle', compact('detalleRequisicion','permiso','requisicion','acceso'));
    
            }
            else
            {
                $acceso=1;
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
                return view('detallerequisicion.detalle', compact('detalleRequisicion','permiso','requisicion','acceso'));
    
            }    
        }
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
    public function agregararticulo(Requisicion $requisicion, DetalleRequisicion $detallerequisicion)
    {
        $now = date('Y-m-d');
        $articuloproveedores = ArticulosProveedor::where('id_catalogo','=',$detallerequisicion->id_catalogo)
        ->where('precio','!=',NULL)
        ->where('fechaInicio','<=',$now)
        ->where('fechaFinal','>=',$now)
        ->orderBy('precio', 'asc')
        ->get();

        //return $articuloproveedores;

        return view('detallerequisicion.agregararticulo',compact('detallerequisicion', 'requisicion','articuloproveedores'));
    }
    public function agregararticuloproveedor(Request $request, DetalleRequisicion $detallerequisicion ,ArticulosProveedor $articuloproveedor)
    {
        $detallerequisicion->id_articuloProveedor = $articuloproveedor->id;
        $detallerequisicion->save();
        return redirect()->route('detallerequisiciones.detalle',[$detallerequisicion->requisicion_id ]);
        

    }

}
