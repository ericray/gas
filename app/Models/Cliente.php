<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = ['curp', 'rfc', 'razon_social', 'actividad_economica', 'fecha_registro'];

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function cuenta()
    {
        return $this->hasOne('App\Models\Cuenta');
    }

    public function consumos_clientes()
    {
        return $this->hasMany('App\Models\ConsumoCliente');
    }

    public function coches()
    {
        return $this->hasMany('App\Models\Coche');
    }

    public function asociados()
    {
        return $this->hasMany('App\Models\Asociado');
    }

    public function scopeGetCuentaAndCliente($query,$codigo = '')
    {
        $result = $query->join('personas','personas.id','=','clientes.persona_id')
            ->join('cuentas','cuentas.cliente_id','=','clientes.id')
            ->select(\DB::raw('clientes.id,clientes.numero_cliente,clientes.curp,clientes.rfc,cuentas.codigo_barras,CONCAT(personas.primer_nombre,\' \',personas.segundo_nombre,\' \',personas.primer_apellido,\' \',personas.segundo_apellido) nombre_completo'));

        if(!empty(trim($codigo)))
            $result->where('cuentas.codigo_barras',$codigo);

        return $result;
    }

    public static function cuentaAndCliente($codigo = '')
    {
        return Cliente::getCuentaAndCliente($codigo);
    }

    public function scopePersonaCliente($query,$searchPhrase,$field,$order)
    {
        return $query->join('personas','personas.id','=','clientes.persona_id')
            ->select(\DB::raw('personas.primer_nombre,personas.segundo_nombre,personas.primer_apellido,personas.segundo_apellido,clientes.*'))
            ->where(\DB::raw('CONCAT(personas.primer_nombre,\' \',personas.segundo_nombre,\' \',personas.primer_apellido,\' \',personas.segundo_apellido)'),'LIKE',"%$searchPhrase%")
            ->orderBy('personas.'.$field,$order);
    }
}
