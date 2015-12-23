<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SucursalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sucursales_gasolineras')->insert([
            'nombre' => 'Merida 1',
            'fecha_registro' => Carbon::now(),
            'tipo_sucursal' => 'Matriz',
            'contacto_id' => 2
        ]);
    }
}
