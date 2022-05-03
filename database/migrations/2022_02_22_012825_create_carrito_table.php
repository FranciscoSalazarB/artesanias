<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->boolean('activo');
            $table->timestamps();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idDestino');
        });
        Schema::table('carrito', function(Blueprint $table){
            $table->foreign('idUser')->references('id')->on('user');
            $table->foreign('idDestino')->references('id')->on('destino');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_lineas');
    }
}
