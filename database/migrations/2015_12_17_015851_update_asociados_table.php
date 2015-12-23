<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAsociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asociados', function (Blueprint $table) {
            $table->integer('cliente_id')->unsigned();

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
        Schema::table('asociados', function (Blueprint $table) {
            $table->dropForeign('asociados_cliente_id_foreign');
            $table->dropColumn('cliente_id');
        });
    }
}
