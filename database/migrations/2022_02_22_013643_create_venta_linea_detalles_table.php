<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaLineaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_linea_detalles', function (Blueprint $table) {
            $table->id();
            $table->float('precioVenta');
            $table->bigInteger('porcentajeDescuento');
            $table->float('importeVenta');
            $table->float('descuento');
            $table->timestamps();
            $table->unsignedBigInteger('idVenta')->unsigned();
            $table->unsignedBigInteger('idPieza')->unsigned();
        });
        Schema::table('venta_linea_detalles', function(Blueprint $table){
            $table->foreign('idVenta')->references('id')->on('venta_lineas');
            $table->foreign('idPieza')->references('id')->on('piezas');
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
