<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_barras',30);
            $table->string('descripcion',150);
            $table->string('placa_auto',15);
            $table->dateTime('fecha_registro');
            $table->float('credito_disponible');
            $table->string('periodicidad_consumo');
            $table->integer('cliente_id')->unsigned();
            $table->integer('sucursal_gasolinera_id')->unsigned();
            $table->integer('pregunta_secreta_id')->unsigned();
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
                ->onDelete('cascade');
            $table->foreign('sucursal_gasolinera_id')
                ->references('id')->on('sucursales_gasolineras')
                ->onDelete('cascade');
            $table->foreign('pregunta_secreta_id')
                ->references('id')->on('preguntas_secretas')
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
        Schema::drop('cuentas');
    }
}
