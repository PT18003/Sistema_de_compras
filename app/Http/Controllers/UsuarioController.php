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
class UsuarioController extends Controller
{
    use PasswordValidationRules;
    public function createIndex(Empleado $empleado)
    {
        return view('auth.registro',compact('empleado'));
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
        return redirect()->route('empleados.index');
        
    }

}
