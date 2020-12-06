<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaTrabajo;
use App\Models\Requisicion;
use App\Models\Empleado;
use App\Models\DetalleRequisicion;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class RequisicionController extends Controller
{
    public function index()
    {
        $empleado = Auth::user()->empleado_id;
        $requisiciones = Requisicion::where('creado_id','=',$empleado)->get();
        $mensajeError = NULL;
        return view('requisicion.index', compact('mensajeError','requisiciones'));
    }

    public function create(Request $request)
    {
     
        $requisicion = new Requisicion();
        $empleado = Auth::user()->empleado_id;
        $requisicion->creado_id=$empleado;
        $requisiciones = Requisicion::where('estado_req','<','2')->count();
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
    }
    


}
