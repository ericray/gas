<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalesGasolinerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales_gasolineras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->dateTime('fecha_registro');
            $table->string('tipo_sucursal');
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
        Schema::drop('sucursales_gasolineras');
    }
}
