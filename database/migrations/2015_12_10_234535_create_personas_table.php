<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre',100);
            $table->string('segundo_nombre',150);
            $table->string('primer_apellido',100);
            $table->string('segundo_apellido',100);
            $table->dateTime('fecha_nacimiento');
            $table->integer('contacto_id')->unsigned();
            $table->timestamps();

            $table->foreign('contacto_id')
                ->references('id')->on('contactos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personas');
    }
}
