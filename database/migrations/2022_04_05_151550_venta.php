<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Venta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table){
            $table->id();
            $table->date('fechaPago');
            $table->string('metodoPago');
            $table->string('estadoActual');
            $table->unsignedBigInteger('idCarrito');
            $table->foreign('idCarrito')->references('id')->on('carrito');
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
