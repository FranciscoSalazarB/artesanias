<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstadoActual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_actual', function (Blueprint $table){
            $table->id();
            $table->string('estadoNombre');
            $table->date('fecha');
            $table->boolean('activo');
            $table->unsignedBigInteger('idVenta');
            $table->foreign('idVenta')->references('id')->on('venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
