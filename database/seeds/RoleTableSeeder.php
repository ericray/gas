<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert([
            'name' => 'administrador',
            'display_name' => 'Administrador',
            'description' => 'Hace todo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('roles')->insert([
            'name' => 'cliente',
            'display_name' => 'Cliente',
            'description' => 'Cliente del sistema',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
