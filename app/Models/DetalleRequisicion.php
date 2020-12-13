<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRequisicion extends Model
{
    protected $table = 'detalleRequisicion';
    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'id_catalogo');
    }
    public function articuloProveedor()
    {
        return $this->belongsTo(ArticulosProveedor::class,'id_articuloProveedor');
    }
     public function requisicion()
    {
        return $this->belongsTo(Requisicion::class, 'requisicion_id');
    }



}
