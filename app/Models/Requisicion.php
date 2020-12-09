<?php

namespace App\Models;

use App\Http\Middleware\Emple;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    protected $table = 'requisiciones';
    public function catalogo()
    {
        return $this->belongsToMany(Catalogo::class,'detalleRequisicion','requisicion_id','id_catalogo')->withTimestamps();
    }
    public function articuloProveedor()
    {
        return $this->hasMany(DetalleRequisicion::class,'requisicion_id','id');
    }
    public function creado()
    {
        return $this->belongsTo(Empleado::class,'creado_id');
    }
    public function aceptado()
    {
        return $this->belongsTo(Empleado::class,'aceptado_id');
    }
    public function encargado()
    {
        return $this->belongsTo(Empleado::class,'encargado_id');
    }
    

}
