<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaTrabajo;
use App\Models\Requisicion;
use App\Models\Empleado;
use App\Models\DetalleRequisicion;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Else_;
use Svg\Tag\Rect;

class RequisicionController extends Controller
{
    public function index()
    {
        
        $empleado = Auth::user()->empleado_id;
        $empleadobuscar = Empleado::find($empleado)->areatrabajo_id;
        if($empleadobuscar==3)
        {
            $permiso =3;
            $requisiciones =  Requisicion::where('estado_req','=','1')->orWhere('estado_req','=','2')->orWhere('estado_req','=','3')->get();
            $mensajeError = NULL;
            return view('requisicion.index', compact('mensajeError','requisiciones','permiso'));
        }
        else
        {
            if($empleadobuscar==2)
            {
                $permiso =2;
                $requisiciones =  Requisicion::where('estado_req','=','2')->get();
                $mensajeError = NULL;
                return view('requisicion.index', compact('mensajeError','requisiciones','permiso'));
    
            }
            else
            {
                $permiso =1;
                $requisiciones = Requisicion::where('creado_id','=',$empleado)->get();
                $mensajeError = NULL;
                return view('requisicion.index', compact('mensajeError','requisiciones','permiso'));    
            }
        }


    }

    public function create(Request $request)
    {
     
        $requisicion = new Requisicion();
        $empleado = Auth::user()->empleado_id;
        $requisicion->creado_id=$empleado;
        $requisiciones = Requisicion::where('estado_req','<','2')->where('creado_id','=',$empleado)->count();
        if($requisiciones >=3)
        {
            $mensajeError = "No se puedes realizar mas de 3 requisiciones si no han sido aceptadas o enviadas";
            $empleado = Auth::user()->empleado_id;
            $requisiciones = Requisicion::where('creado_id','=',$empleado)->get();
            return view('requisicion.index', compact('mensajeError','requisiciones'));
        }
        else
        {
            $mensajeError = NULL;
            $requisicion->save();
            return redirect()->route('detallerequisiciones.index',[$requisicion->id]);
        }

    }
    public function send(Request $request, Requisicion $requisicion)
    {
        $requisicion->estado_req=1;
        $requisicion->save();
        return redirect()->route('detallerequisiciones.index',[$requisicion->id]);
    }
    public function aceptar(Request $request, Requisicion $requisicion)
    {

        $requisicion->estado_req=2;
        $empleado = Auth::user()->empleado_id;
        $requisicion->aceptado_id=$empleado;
        $requisicion->fechaAceptada=date('Y-m-d H:i:s');
        $requisicion->save();
        return  redirect()->route('requisiciones.index');
    }
    public function denegar(Request $request, Requisicion $requisicion)
    {

        $requisicion->estado_req=3;
        $empleado = Auth::user()->empleado_id;
        $requisicion->aceptado_id=$empleado;
        $requisicion->save();
        return redirect()->route('requisiciones.index');
    }
    public function ordenar(Request $request, Requisicion $requisicion)
    {
        return $requisicion;
        //$detallerequisicion = DetalleRequisicion::where
    }


}
