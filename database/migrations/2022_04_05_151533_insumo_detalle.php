<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsumoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo_detalle', function (Blueprint $table){
            $table->id();
            $table->float('cantidadUsada');
            $table->string('unidadMedida');
            $table->unsignedBigInteger('idCarritoDetalle')->unsigned();
            $table->unsignedBigInteger('idHistorico')->unsigned();
        });

        Schema::table('insumo_detalle', function(Blueprint $table){
            $table->foreign('idCarritoDetalle')->references('id')->on('carrito_detalle');
            $table->foreign('idHistorico')->references('id')->on('historico_precio');
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
