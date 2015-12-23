<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('clientes')->insert([
           'numero_cliente' => '001',
           'curp' => 'LOAE920803',
           'rfc' => 'LOAE920803',
           'razon_social' => null,
           'actividad_economica' => null,
           'fecha_registro' => Carbon::now(),
           'persona_id' => 1,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now(),
       ]);
    }
}
