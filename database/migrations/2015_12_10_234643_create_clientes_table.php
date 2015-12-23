<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_cliente',30);
            $table->string('curp',20);
            $table->string('rfc',30);
            $table->string('razon_social',100)->nullable();
            $table->string('actividad_economica',100)->nullable();
            $table->dateTime('fecha_registro');
            $table->integer('persona_id')->unsigned();
            $table->timestamps();

            $table->foreign('persona_id')
                ->references('id')->on('personas')
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
        Schema::drop('clientes');
    }
}
