<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRequisicion extends Model
{
    protected $table = 'detallerequisicion';
    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'id_catalogo');
    }

     public function requisicion()
    {
        return $this->belongsTo(Requisicion::class, 'requisicion_id');
    }

}
