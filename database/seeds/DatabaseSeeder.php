<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(ContactoTableSeeder::class);
        $this->call(PersonaTableSeeder::class);
        $this->call(ClienteTableSeeder::class);
        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
