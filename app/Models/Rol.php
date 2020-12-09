<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';

     /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
       	'nombre',
    	'descripcion',
    ];

     public function users()
    {

            return $this->hasMany(User::class, 'id_rol');
    }
}
