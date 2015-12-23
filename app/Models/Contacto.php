<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';
    protected $fillable = ['calle','numero_interior','numero_exterior','cruzamientos','asentamiento','municipio','entidad_federativa','correo','telefono_fijo','telefono_movil'];
}
