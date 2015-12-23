<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domicilio');
            $table->string('telefono_fijo');
            $table->string('telefono_movil');
            $table->string('correo')->unique();
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
        Schema::drop('asociados');
    }
}
