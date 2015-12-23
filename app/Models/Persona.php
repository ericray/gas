<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /**
     * Table of database
     *
     * @var string
     */
    protected $table = 'personas';

    /**
     * Attributes for massive assignation
     *
     * @var array
     */
    protected $fillable = ['primer_nombre','segundo_nombre','primer_apellido','segundo_apellido','fecha_nacimiento'];

    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente');
    }

    public function asociado()
    {
        return $this->hasOne('App\Models\Asociado');
    }

    public function getFullNameAttribute()
    {
        return $this->primer_nombre .' '.$this->segundo_nombre.' '.$this->primer_apellido.' '.$this->segundo_apellido;
    }
}
