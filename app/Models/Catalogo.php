<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogos';
    public function proveedor()
    {
        return $this->belongsToMany(Proveedor::class,'articulos_proveedores','id_catalogo','id_proveedor')->withTimestamps();
    }
    public function requisicion()
    {
        return $this->belongsToMany(Requisicion::class,'detallerequisicion','id_catalogo','requisicion_id')->withTimestamps();
    }
    public function articuloCatalogo()
    {
        return $this->hasMany(ArticulosProveedor::class,'id_catalogo','id');

    }
}
