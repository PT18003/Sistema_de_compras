<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Municipio;
use App\Models\Departamento;
use App\Models\EstadoCivil;
use App\Models\Genero;
use App\Models\AreaTrabajo;
use App\Models\Requisicion;
use App\Models\Catalogo;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoCreate;

use App\Models\DetalleRequisicion;

use Barryvdh\DomPDF\Facade as PDF;


class EmpleadoController extends Controller
{
    public function create()
    {
        $departamentos = Departamento::all();
        $municipios= Municipio::all();
        $estadocivil = EstadoCivil::all();
        $generos= Genero::all();
        $areatrabajo = AreaTrabajo::all();
        return view('empleados.create',compact('municipios','estadocivil','departamentos','generos','areatrabajo'));
    }
    public function dashboard()
    {
        $proveedores = Proveedor::get();
        $countempleados = Empleado::count();
        $countareas = AreaTrabajo::count();
        $countproveedores = Proveedor::count();
        $countarticulos = Catalogo::count();
        $join =DB::table('requisiciones')->join('detalleRequisicion','requisiciones.id','=','detalleRequisicion.requisicion_id')
        ->join('articulos_proveedores','detalleRequisicion.id_articuloProveedor','=','articulos_proveedores.id')
        ->join('proveedores','proveedores.id','=','articulos_proveedores.id_proveedor')
        ->select('proveedores.id','detalleRequisicion.ordenCompra','requisiciones.id as rid')
        ->distinct('detalleRequisicion.ordenCompra')
        ->groupBy('detalleRequisicion.ordenCompra','proveedores.id','requisiciones.id')
        ->get();
        
        $ordenes = DetalleRequisicion::select()->whereNotNull('ordenCompra')->get();
       
     
        return view('dashboard',compact('countempleados','countareas','countproveedores','countarticulos','join','ordenes','proveedores'));
    }
    public function exportPdf()
    {
        $empleados = Empleado::get();
        $requisiciones = Requisicion::get();
        $pdf = PDF::loadView('pdf.empleados',compact('empleados'),compact('requisiciones'));
        return $pdf->download('empleados-list.pdf');
    }
    public function doc()
    {
        $empleados=Empleado::get();
        $requisiciones = Requisicion::get();
        return view('pdf.empleados', compact('empleados'),compact('requisiciones'));
    }

    public function exportRequisicionCPdf(Requisicion $requisicion)
    {
        $requisicion = Requisicion::where('id',$requisicion->id)->first();
        $detalleRequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
        $name = 'comprobante-requisicion-'.$requisicion->id.'.pdf';
      
        $pdf = PDF::loadView('pdf.requisicioncompra',compact('detalleRequisicion','requisicion'));
        return $pdf->download($name);

    }
    public function pruebaPdf(Requisicion $requisicion)
    {
        $requisicion = Requisicion::where('id',$requisicion->id)->first();
        $detalleRequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
        $name = 'comprobante-requisicion-'.$requisicion->id.'.pdf';
      
      


        return view('pdf.ordencompra',compact('detalleRequisicion','requisicion'));
    }
    
    public function exportOrdenPdf(Requisicion $requisicion)
    {
        $requisicion = Requisicion::where('id',$requisicion->id)->first();
        $detalleRequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
        $name = 'comprobante-orden-'.$requisicion->id.'.pdf';
      
        $pdf = PDF::loadView('pdf.ordencompra',compact('detalleRequisicion','requisicion'));
        return $pdf->download($name);
    }
    
    
/*     public function getTowns(Request $request,$id)
    {
        if($request->ajax())
        {
            $towns = Empleado::towns($id);
            return response()->json($towns);
        }
    } */

    public function getTowns(Request $request,$id)
    {
        if($request->ajax())
        {
            $towns = Empleado::towns($id);
            return response()->json($towns);
        }
    }
    public function geteTowns(Request $request,Empleado $empleado)//ignorar esto
    {

            return response()->json($empleado);
        
    }
    public function guardar(EmpleadoCreate $request)
    {
        $empleado = new Empleado();
        $empleado->nombres=$request->nombres;
        $empleado->apellidos=$request->apellidos;
        $empleado->direccion=$request->direccion;
        $empleado->municipio_id=$request->municipio;
        $empleado->genero_id=$request->genero;
        $empleado->telefono=$request->telefono;
        $empleado->dui=$request->dui;
        $empleado->salario=$request->salario;
        $empleado->vencimientoContrato=$request->vencimientoContrato;
        $empleado->areatrabajo_id=$request->areatrabajo;
        $empleado->estadocivil_id=$request->estadocivil;
        $empleado->save();
        return redirect()->route('empleados.index');
    }
    public function index()
    {
        $empleados=Empleado::paginate(10);
        return view('empleados.view', compact('empleados'));
    }
    public function edit(Empleado $empleado)
    {
        $departamentos = Departamento::all();
        $municipios= Municipio::all();
        $estadocivil = EstadoCivil::all();
        $generos= Genero::all();
        $areatrabajo = AreaTrabajo::all();
        return view('empleados.edit',compact('empleado','municipios','estadocivil','departamentos','generos','areatrabajo'));
    }
    public function actualizar(EmpleadoCreate $request, Empleado $empleado)
    {
        $empleado->nombres=$request->nombres;
        $empleado->apellidos=$request->apellidos;
        $empleado->direccion=$request->direccion;
        $empleado->municipio_id=$request->municipio; 
        $empleado->genero_id=$request->genero;
        $empleado->telefono=$request->telefono;
        $empleado->dui=$request->dui;
        $empleado->salario=$request->salario;
        $empleado->vencimientoContrato=$request->vencimientoContrato;
        $empleado->areatrabajo_id=$request->areatrabajo;
        $empleado->estadocivil_id=$request->estadocivil;
        $empleado->save();
        return redirect()->route('empleados.index');
    }
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();//como ya se agrego el softdelete, no lo borra, pero en el index ya no aparecera. 
        return redirect()->route('empleados.index'); 
    }
    public function view(Empleado $empleado)
    {
        $departamentos = Departamento::all();
        $municipios= Municipio::all();
        $estadocivil = EstadoCivil::all();
        $generos= Genero::all();
        $areatrabajo = AreaTrabajo::all();
        return(compact('empleado','municipios','estadocivil','departamentos','generos','areatrabajo'));
    }
}
