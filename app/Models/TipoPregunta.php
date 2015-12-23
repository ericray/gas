<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPregunta extends Model
{
    protected $table = 'tipos_preguntas';

    protected $fillable = ['descripcion'];
}
