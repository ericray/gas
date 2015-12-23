<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $table = 'detalles_ordenes';

    protected $fillable = ['producto_id','precio_producto','cantidad_producto'];

    public function orden()
    {
        return $this->belongsTo('App\Models\Orden');
    }

    public function scopeGetProductosByDetalle($query,$id)
    {
        return $query->join('productos','productos.id','=','detalles_ordenes.producto_id')
            ->select(\DB::raw('productos.id,productos.nombre,detalles_ordenes.cantidad_producto cantidad,detalles_ordenes.precio_producto precio'))
            ->where('detalles_ordenes.orden_id','=',$id);
    }

    public static function productosByDetalle($id)
    {
        return DetalleOrden::getProductosByDetalle($id);
    }
}
