<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipos_pagos')->insert([
            'descripcion' => 'En efectivo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('tipos_pagos')->insert([
            'descripcion' => 'Tarjeta de crédito',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('tipos_pagos')->insert([
            'descripcion' => 'Tarjeta de débito',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
