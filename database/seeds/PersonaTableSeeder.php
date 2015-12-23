<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('personas')->insert([
            'primer_nombre' => 'Eric',
            'segundo_nombre' => 'Raymundo',
            'primer_apellido' => 'López',
            'segundo_apellido' => 'Alonzo',
            'fecha_nacimiento' => '1992-08-03',
            'contacto_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
