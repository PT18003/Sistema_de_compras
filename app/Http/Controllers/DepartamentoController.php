<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;//modelo de departamento
class DepartamentoController extends Controller
{
    //creando el controlador para mostrar los datos en una tabla. 
    public function index()
    {
        //sirve para paginar los elemntos del model
        $departamentos = Departamento::paginate(7);
        //dentro de view va: [nombre carpeta.archivo] el archivo sin blade.php 
        //en el compact debe de ir la variable de arriba. que es para mandar los elemntos. 
        return view('departamentos.view', compact('departamentos'));
    }
    //creando la funcion para agregar un nuevo departamento
    public function create()
    {
        return view('departamentos.create');
    }
    public function guardar(Request $request)
    {
        //instanciamos departamento 
        $departamento = New Departamento();
        //variable->[nombre del campo de la tabla] = $request->[nombre del imput]
        $departamento->departamento = $request->departamento;
        //ejecutamos metodo guardar
        $departamento->save();
        return redirect()->route('departamentos.index');
    }
    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamento'));
    }
    public function actualizar(Request $request, Departamento $departamento)
    {
        $departamento->departamento = $request->departamento;
        $departamento->save();
        return redirect()->route('departamentos.index');
    }
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();
        return redirect()->route('departamentos.index'); 
    }
    //aqui no se
    function fetch_data(Request $request)
    {
        
       
      
        if($request->ajax())
        {
            $data = Departamento::get();
            echo json_encode($data);
        }
    }
    function add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                
                'departamento'=>  $request->departamento
            );
            $id = Departamento::insert($data);
            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Inserted</div>';
            }
        } 
    }

    function update_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name  =>  $request->column_value
            );
            Departamento::where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
           Departamento::where('id', $request->id)
                ->delete();
            echo '<div class="alert alert-success">Registro borrado</div>';
        }
    }
}
