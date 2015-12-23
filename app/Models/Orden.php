<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Orden extends Model
{
    protected $table = 'ordenes';

    //protected $fillable = ['numero_productos','total_productos','fecha','estatus'];

    public function detalle_orden()
    {
        return $this->hasOne('App\Models\DetalleOrden');
    }

    public function scopeGetOrdenesCliente($query)
    {
        return $query->join('clientes','clientes.id','=','ordenes.cliente_id')
            ->join('personas','personas.id','=','clientes.persona_id')
            ->join('tipos_pagos','tipos_pagos.id','=','ordenes.tipo_pago_id')
            ->where('ordenes.total_productos','>',0)
            ->select(\DB::raw('ordenes.fecha,ordenes.total_productos importe, CONCAT(personas.primer_nombre,\' \',personas.segundo_nombre,\' \',personas.primer_apellido,\' \',personas.segundo_apellido) cliente,ordenes.estatus,tipos_pagos.descripcion tipo_pago'));
    }

    public static function ordenesCliente()
    {
        return Orden::getOrdenesCliente();
    }
}
