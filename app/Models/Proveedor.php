<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;	
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;//para borrado logico
    protected $table = 'proveedores';

     /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'id_municipio',
    	'nombre',
    	'direccion',
    	'telefono',
    	'correo',
    	'nit',
    	'montoMin',
    ];

     public function municipio()//funcion o metodo que son para relacionar, usar belongsTo en las tablas hijas.
    {
        return $this->belongsTo(Municipio::class,'municipio_id');
    }
}