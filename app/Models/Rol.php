<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use SoftDeletes;//para borrado logico
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
