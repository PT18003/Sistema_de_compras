<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogos';
    public function proveedor()
    {
        return $this->belongsToMany(Catalogo::class,'articulos_proveedores','id_catalogo','id_proveedor');
    }
    public function articuloCatalogo()
    {
        return $this->hasMany(ArticulosProveedor::class,'id_catalogo','id');

    }
}
