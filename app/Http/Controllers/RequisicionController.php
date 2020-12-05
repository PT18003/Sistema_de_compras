<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaTrabajo;
use App\Models\Requisicion;
use App\Models\Empleado;

class RequisicionController extends Controller
{
    public function create()
    {
        $empleado= Empleado::all();
        return view('requisicions.create',compact('empleado'));
    }

    public function guardar(EmpleadoCreate $request)
    {
        $requisicion = new requisicion();
        $requisicion->fecha_aceptado=$request->fecha_aceptado;
        $requisicion->creado_id=$request->empleado;
        $requisicion->aceptado_id=$request->empleado;
        $requisicion->encargado_id=$request->empleado;
        $requisicion->estado_req=$request->estado_req;
        
        $requisicion->save();
        return redirect()->route('requisicion.index');
    }

    public function index()
    {
        $requisicions=Requisicion::paginate(10);
        return view('requisicions.view', compact('requisicions'));
    }



}
