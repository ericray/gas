<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContactoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contactos')->insert([
            'calle' => '71',
            'numero_interior' => '213',
            'numero_exterior' => '0',
            'cruzamientos' => '14 y 16',
            'asentamiento' => 'Azcorra',
            'municipio' => 'Mérida',
            'entidad_federativa' => 'Yucatán',
            'correo' => 'eric.lopez.alonzo@gmail.com',
            'telefono_fijo' => '3459878',
            'telefono_movil' => '9992893678',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        \DB::table('contactos')->insert([
            'calle' => '55',
            'numero_interior' => '422',
            'numero_exterior' => '0',
            'cruzamientos' => '19 y 21',
            'asentamiento' => 'México',
            'municipio' => 'Mérida',
            'entidad_federativa' => 'Yucatán',
            'correo' => 'contacot@merida1.com',
            'telefono_fijo' => '9823892309',
            'telefono_movil' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
