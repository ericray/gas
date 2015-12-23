<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaSecreta extends Model
{
    protected $table = 'preguntas_secretas';

    protected $fillable = ['pregunta','respuesta'];
}
