<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle',50);
            $table->string('numero_interior',10);
            $table->string('numero_exterior',10);
            $table->string('cruzamientos');
            $table->string('asentamiento');
            $table->string('municipio');
            $table->string('entidad_federativa');
            $table->string('correo')->unique();
            $table->string('telefono_fijo');
            $table->string('telefono_movil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contactos');
    }
}
