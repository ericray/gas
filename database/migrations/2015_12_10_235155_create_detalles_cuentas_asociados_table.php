<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesCuentasAsociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_cuentas_asociados', function (Blueprint $table) {
            $table->increments('id');
            $table->float('limite_consumo');
            $table->string('periodicidad_consumo');
            $table->integer('cuenta_id')->unsigned();
            $table->integer('asociado_id')->unsigned();
            $table->timestamps();

            $table->foreign('cuenta_id')
                ->references('id')->on('cuentas')
                ->onDelete('cascade');
            $table->foreign('asociado_id')
                ->references('id')->on('asociados')
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
        Schema::drop('detalles_cuentas_asociados');
    }
}
