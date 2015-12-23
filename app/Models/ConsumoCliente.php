<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumoCliente extends Model
{
    protected $table = 'consumos_clientes';

    protected $fillable = ['importe','cliente_id'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function coche()
    {
        return $this->belongsTo('App\Models\Coche');
    }
}
