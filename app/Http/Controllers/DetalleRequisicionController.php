<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Requisicion;
use App\Models\Catalogo;
use Illuminate\Http\Request;
use App\Models\DetalleRequisicion;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use App\Models\AreaTrabajo;


use Barryvdh\DomPDF\Facade as PDF;
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

    public function artempledos()
    {
        $empleados = Empleado::get();
        $suma = DB::table('requisiciones')->join('detalleRequisicion','requisiciones.id','=','detalleRequisicion.requisicion_id')
        ->join('Empleados','requisiciones.creado_id','=','Empleados.id')->select('Empleados.id','Empleados.nombres','Empleados.apellidos',DB::raw('Sum(detalleRequisicion.cantidad) as total'))
        ->groupBy('Empleados.id','Empleados.nombres','Empleados.apellidos')->get();

        return view('reportes.artempleados', compact('empleados','suma'));
    }
    public function artareas()
    {
        $requisiciones = Requisicion::get();
        $areas = AreaTrabajo::get();
        $suma = DB::table('requisiciones')->join('detalleRequisicion','requisiciones.id','=','detalleRequisicion.requisicion_id')
        ->join('Empleados','requisiciones.creado_id','=','Empleados.id')
        ->join('AreaTrabajo','Empleados.areatrabajo_id','=','AreaTrabajo.id')
        ->select('Empleados.areatrabajo_id','AreaTrabajo.nombreDep',DB::raw('Sum(detalleRequisicion.cantidad) as total'))
        ->groupBy('Empleados.areatrabajo_id','AreaTrabajo.nombreDep')->get();

        return view('reportes.artareas', compact('areas','suma','requisiciones'));
    }
    public function artareasPdf()
    {
        $requisiciones = Requisicion::get();
        $areas = AreaTrabajo::get();
        $suma = DB::table('requisiciones')->join('detalleRequisicion','requisiciones.id','=','detalleRequisicion.requisicion_id')
        ->join('Empleados','requisiciones.creado_id','=','Empleados.id')
        ->join('AreaTrabajo','Empleados.areatrabajo_id','=','AreaTrabajo.id')
        ->select('Empleados.areatrabajo_id','AreaTrabajo.nombreDep',DB::raw('Sum(detalleRequisicion.cantidad) as total'))
        ->groupBy('Empleados.areatrabajo_id','AreaTrabajo.nombreDep')->get();
        
        $name = 'reporte-areas.pdf';
      
        $pdf = PDF::loadView('pdf.artareas', compact('areas','suma','requisiciones'));
        return $pdf->download($name);
    
    }
    public function artempleadosPdf()
    {
        $empleados = Empleado::get();
        $suma = DB::table('requisiciones')->join('detalleRequisicion','requisiciones.id','=','detalleRequisicion.requisicion_id')
        ->join('Empleados','requisiciones.creado_id','=','Empleados.id')->select('Empleados.id','Empleados.nombres','Empleados.apellidos',DB::raw('Sum(detalleRequisicion.cantidad) as total'))
        ->groupBy('Empleados.id','Empleados.nombres','Empleados.apellidos')->get();
    
        $name = 'reporte-articulos-empleados.pdf';
      
        $pdf = PDF::loadView('pdf.artempleados', compact('empleados','suma'));
        return $pdf->download($name);
    
    }
    public function pruebaPdf()
    {
        $empleados = Empleado::get();
        $suma = DB::table('requisiciones')->join('detalleRequisicion','requisiciones.id','=','detalleRequisicion.requisicion_id')
        ->join('Empleados','requisiciones.creado_id','=','Empleados.id')->select('Empleados.id','Empleados.nombres','Empleados.apellidos',DB::raw('Sum(detalleRequisicion.cantidad) as total'))
        ->groupBy('Empleados.id','Empleados.nombres','Empleados.apellidos')->get();

        return view('pdf.artempleados', compact('empleados','suma'));
    }
}
