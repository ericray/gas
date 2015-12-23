<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id');
            $table->float('precio_producto');
            $table->integer('cantidad_producto');
            $table->integer('orden_id')->unsigned();
            $table->timestamps();

            $table->foreign('orden_id')
                ->references('id')->on('ordenes')
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
        Schema::drop('detalles_ordenes');
    }
}
