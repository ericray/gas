<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuentas';

    protected $fillable = ['codigo_barras','descripcion','placa_auto','credito_disponible','periodicidad_consumo'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
}
