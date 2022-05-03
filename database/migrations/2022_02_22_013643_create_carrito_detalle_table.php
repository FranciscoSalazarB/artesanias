<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_detalle', function (Blueprint $table) {
            $table->id();
            $table->float('precioVenta');
            $table->bigInteger('porcentajeDescuento');
            $table->float('importeVenta');
            $table->float('descuento');
            $table->timestamps();
            $table->unsignedBigInteger('idCarrito')->unsigned();
            $table->unsignedBigInteger('idPieza')->unsigned();
        });
        Schema::table('carrito_detalle', function(Blueprint $table){
            $table->foreign('idCarrito')->references('id')->on('carrito');
            $table->foreign('idPieza')->references('id')->on('pieza');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_linea_detalles');
    }
}
