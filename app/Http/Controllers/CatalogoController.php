<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogo;
use DB;
use Illuminate\Support\Facades\Storage;

class CatalogoController extends Controller
{
    public function index(){
        $catalogos = DB::table('catalogos')->get();
        return view('catalogo.view', compact('catalogos'));
    }

    public function destroy(Request $request){
        // dd($request);
        $delete = DB::table('catalogos')->where(['id'=>$request->catalogo])->delete();
        return redirect()->route('catalogos.index');
    }

    public function edit(Request $request){
        $id = (int)$request->catalogo;
        $catalogo = DB::table('catalogos')->where(['id'=>$id])->get();
        return view('catalogo.edit', compact('catalogo'));
    }

    public function actualizar(Request $request, Catalogo $catalogo){
        // dd($request->imagen);
        if($request->hasFile('imagen')){
            $photo = Storage::put('public', $request->imagen);
            $url = Storage::url($photo);
            $fullUrl = asset($url);
            $update = DB::table('catalogos')->where(['id'=>$request->id])
            ->update(['nombre'=>$request->nombre, 'descripcion'=>$request->descripcion, 'imagen'=>$fullUrl, 'minimo'=> $request->minimo, 'maximo' => $request->maximo]);
        }else{
            $update = DB::table('catalogos')->where(['id'=>$request->id])
            ->update(['nombre'=>$request->nombre, 'descripcion'=>$request->descripcion, 'minimo'=> $request->minimo, 'maximo' => $request->maximo]);
        }
        return redirect()->route('catalogos.index');
    }

    public function create(Request $request){
        //$delete = DB::table('catalogos')->where(['id'=>$request->id])->delete();
        return view('catalogo.create');
    }

    public function guardar(Request $request){
        $fullUrl;
        if ($request->hasFile('imagen')) {
            $photo = Storage::put('public', $request->imagen);
            $url = Storage::url($photo);
            $fullUrl = asset($url);
            Storage::setVisibility($photo, 'public');
        }
        $cat = new Catalogo();
        $cat->nombre = $request->nombre;
        $cat->descripcion = $request->descripcion;
        $cat->minimo = $request->minimo;
        $cat->maximo = $request->maximo;
        $cat->imagen = $fullUrl;
        $cat->save();
        return redirect()->route('catalogos.index');
        // dd($request);
    }
}
