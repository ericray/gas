<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Asociado extends Model
{
    protected $table = 'asociados';

    protected $fillable = ['domicilio','telefono_fijo','telefono_movil','correo'];

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function scopeGetPersonaAsociado($query,$cliente_id,$searchPhrase,$field,$order)
    {
        return $query->join('personas','personas.id','=','asociados.persona_id')
            ->where(\DB::raw('CONCAT(personas.primer_nombre,\' \',personas.segundo_nombre,\' \',personas.primer_apellido,\' \',personas.segundo_apellido)'),'LIKE',"%$searchPhrase%")
            ->where('cliente_id',$cliente_id)
            ->orderBy('personas.'.$field,$order)
            ->select(\DB::raw('asociados.*,CONCAT(personas.primer_nombre,\' \',personas.segundo_nombre,\' \',personas.primer_apellido,\' \',personas.segundo_apellido) primer_nombre'));
    }

    public function scopeGetPersonaAsociadoSingle($query,$id)
    {
        return $query->join('personas','personas.id','=','asociados.persona_id')
            ->select(\DB::raw('personas.primer_nombre,personas.segundo_nombre,personas.primer_apellido,personas.segundo_apellido,date_format(personas.fecha_nacimiento,\'%d/%m/%Y\') fecha_nacimiento,asociados.*'))
            ->where('asociados.id',$id)
            ->first();
    }
}
