<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_detalle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idVenta')->unsigned();
            $table->unsignedBigInteger('idPieza')->unsigned();
        });
        Schema::table('venta_detalle', function(Blueprint $table){
            $table->foreign('idVenta')->references('id')->on('venta');
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
