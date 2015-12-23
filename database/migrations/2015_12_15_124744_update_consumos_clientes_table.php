<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConsumosClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumos_clientes', function (Blueprint $table) {
            $table->integer('coche_id')->unsigned();

            $table->foreign('coche_id')
                ->references('id')->on('coches')
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
        Schema::table('consumos_clientes', function (Blueprint $table) {
            $table->dropForeign('consumos_clientes_coche_id_foreign');
            $table->dropColumn('coche_id');
        });
    }
}
