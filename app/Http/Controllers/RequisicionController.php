<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaTrabajo;
use App\Models\Requisicion;
use App\Models\Empleado;
use App\Models\DetalleRequisicion;
use App\Models\ArticulosProveedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Node\Builder;
use PhpParser\Node\Stmt\Else_;
use Svg\Tag\Rect;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionProveedor;
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
                $requisiciones =  Requisicion::where('estado_req','=','2')->orWhere('estado_req','=','4')->get();
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
        
        $empleadobuscar = Empleado::find($empleado)->areatrabajo_id;
        $requisiciones = Requisicion::where('estado_req','<','2')->where('creado_id','=',$empleado)->count();
        if($requisiciones >=3)
        {
            if($empleadobuscar==3)
            {
                $permiso = 3;
                $mensajeError = "No se puedes realizar mas de 3 requisiciones si no han sido aceptadas o enviadas";
                $empleado = Auth::user()->empleado_id;
                $requisiciones = Requisicion::where('creado_id','=',$empleado)->get();
                return view('requisicion.index', compact('mensajeError','requisiciones','permiso'));
            }
            if($empleadobuscar==2)
            {
                $permiso = 2;
                $mensajeError = "No se puedes realizar mas de 3 requisiciones si no han sido aceptadas o enviadas";
                $empleado = Auth::user()->empleado_id;
                $requisiciones = Requisicion::where('creado_id','=',$empleado)->get();
                return view('requisicion.index', compact('mensajeError','requisiciones','permiso'));
            }
            if($empleadobuscar==1)
            {
                $permiso = 1;
                $mensajeError = "No se puedes realizar mas de 3 requisiciones si no han sido aceptadas o enviadas";
                $empleado = Auth::user()->empleado_id;
                $requisiciones = Requisicion::where('creado_id','=',$empleado)->get();
                return view('requisicion.index', compact('mensajeError','requisiciones','permiso'));
            }
           
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
    public function correoProveedor ()
    {
        $receivers = 'migue.galdamez@hotmail.com';
        Mail::to($receivers)->send(new NotificacionProveedor());
    }
    public function ordenar(Request $request, Requisicion $requisicion)
    {
        $cuenta=  DetalleRequisicion::where('requisicion_id',$requisicion->id)->count();
        $cuentaProveedores = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get()->groupBy('articuloProveedor.id_proveedor')->count();
        $codigosguardados = DetalleRequisicion::select('ordenCompra')->groupBy('ordenCompra')->get();
        $detallerequisicion = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get();
        $porProveedores = DetalleRequisicion::where('requisicion_id',$requisicion->id)->get()->groupBy('articuloProveedor.id_proveedor');//muestra articulos por proveedores


        /* INICIO DE COMPROBACIONDE ARTICULOS ESTEN EN LA FECHA */
        $now = date('Y-m-d');
        $articuloproveedores = ArticulosProveedor::where('precio','!=',NULL)
        ->where('fechaInicio','<=',$now)
        ->where('fechaFinal','>=',$now)
        ->get();
        $cont =0;
        foreach($detallerequisicion as $item)//para comprobar que esten todos si la fecha se paso
        {
            foreach($articuloproveedores as $item1)
            {
                if($item->id_articuloProveedor==$item1->id)
                {
                    $cont = 1+$cont;
                }
            }
        }
        /* FIN DE COMPROBACIONDE ARTICULOS ESTEN EN LA FECHA */

        /* Sacamos los keys a un array solito */
        $porProveedoresArray= $porProveedores->toArray();
        $idProveedores = array_keys($porProveedoresArray);
        /* FIn de sacar los keys */
        
        /* Vairables para comprobar si un codigo esta guardado */
        $codigosconta=0;
        $arraycodigosguardados  = [];
        /* Fin de declaracion del bloque */
        if($cuenta==$cont)//si es igual es por que aun los items escogidos estan aun listos para la fecha
        {
            foreach ($idProveedores as $itemm)//foreach para actualizar por proveedor
            {
                $seguir=1;
                while($seguir == 1)
                {
                    $longitud =8;
                    $key = '';
                    $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $max = strlen($pattern)-1;
                    for($i=0;$i < $longitud;$i++)
                    {
                        $key .= $pattern{mt_rand(0,$max)};
                    }
                    $articuloproveedores = ArticulosProveedor::where('precio','!=',NULL)
                    ->where('fechaInicio','<=',$now)
                    ->where('fechaFinal','>=',$now)
                    ->get();
                    foreach($codigosguardados as $item)//guardar los codigos en un array
                    {
                        $arraycodigosguardados[$codigosconta]=$item->ordenCompra;
                        $codigosconta =$codigosconta+1;
                    }
                    for($v=0;$v<sizeof($arraycodigosguardados);$v++)
                    {
                        if($key == $arraycodigosguardados[$v])
                        {
                            $seguir =1;
                        }
                        else
                        {
                            $seguir =0;
                            DetalleRequisicion::whereHas('articuloProveedor', function($query) use ($itemm)
                            {
                                $query->where("id_proveedor","=",$itemm); 
                            })->where('requisicion_id','=',$requisicion->id)->update(['ordenCompra' => $key,'estado_req' => 1]);
                        }
                    }
                }
            }
            $requisicion->estado_req=4;
            $requisicion->save();
        }
    }
}
