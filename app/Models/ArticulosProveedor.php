<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticulosProveedor extends Model
{
    protected $table = 'articulos_proveedores';
    use SoftDeletes;//para borrado logico
    
    


  /*   protected $fillable = [
        'id_inventario',
        'id_proveedor',
        'codigoArticulo',
        'descripcionRol',
        'fechaInicio',
        'fechaFinal',
        'precio',
        'periodoPago',
        'descuento',
        'tiempoEntrega',
    ];
 */
     public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'id_catalogo');
    }

     public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
    public function detallerequisicion()
    {
        return $this->hasMany(DetalleRequisicion::class, 'id_articuloProveedor','id');
    }

}
