<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = ['nombre','descripcion','precio','cantidad'];

    public function scopeProdCart($query,$id)
    {
        return $query->select(\DB::raw('productos.nombre name,productos.precio price, productos.id'))
            ->where('id',$id)
            ->first();
    }

    public static function cart($id)
    {
        return Producto::prodCart($id);
    }
}
