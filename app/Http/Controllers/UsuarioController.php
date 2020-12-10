<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\Empleado;
use App\Models\Rol;
class UsuarioController extends Controller
{
    use PasswordValidationRules;
    public function createIndex(Empleado $empleado)
    {
        $roles= Rol::all();
        return view('auth.registro',compact('empleado','roles'));
    }
    public function editIndex(Empleado $empleado)
    {
        $roles= Rol::all();
        return view('auth.cambio',compact('empleado','roles'));
    }
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();
       
        $usuario=new User();
        $usuario->name = $request->name;
        $usuario->email =$request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->empleado_id=$request->id;
        $usuario->save();
        return redirect()->route('empleados.index')->with('Mensaje','Enhorabuena transaccion exitosa')->with('Complemento','Usuario creado con éxito.');
        
    }
    public function edit(Request $request)
    {
        $usuario=User::find($request->id_user);
        
        if($request->password!="")
        {
            

            if($request->email==$usuario->email)
            {
                validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'password' => $this->passwordRules(),
                ])->validate();
                $usuario->name = $request->name;
                
                $usuario->password = Hash::make($request->password);
                $usuario->empleado_id=$request->id;
            }
            else{
                validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => $this->passwordRules(),
                ])->validate();
                $usuario->name = $request->name;
                $usuario->email =$request->email;
                $usuario->password = Hash::make($request->password);
                $usuario->empleado_id=$request->id;
            }
            
            $usuario->save();
        }
        else
        {
            if($request->email==$usuario->email)
            {
                validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    
                ])->validate();
                $usuario->name = $request->name;
                
                $usuario->password = Hash::make($request->password);
                $usuario->empleado_id=$request->id;
            }
            else{
                validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                   
                ])->validate();
                $usuario->name = $request->name;
                $usuario->email =$request->email;
                $usuario->password = Hash::make($request->password);
                $usuario->empleado_id=$request->id;
            }
            
            $usuario->save();
        }
        $quien = $usuario->empleado->nombres;
        $complemento = "Usuario de empleado $quien modificado con éxito.";
        
      
        return redirect()->route('empleados.index')->with('Mensaje','Enhorabuena transaccion exitosa')->with('Complemento',$complemento);
        
    }
    

}
