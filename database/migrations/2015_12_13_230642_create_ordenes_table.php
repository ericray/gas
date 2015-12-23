<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero_productos');
            $table->integer('total_productos');
            $table->dateTime('fecha');
            $table->integer('estatus');
            $table->integer('cliente_id')->unsigned();
            $table->integer('tipo_pago_id');
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
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
        Schema::drop('ordenes');
    }
}
