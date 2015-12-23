<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    protected $table = 'coches';

    protected $fillable = ['descripcion','marca','modelo'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function consumos()
    {
        return $this->hasMany('App\Models\ConsumoCliente');
    }
}
