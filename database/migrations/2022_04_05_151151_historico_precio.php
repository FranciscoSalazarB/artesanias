<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoricoPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_precio', function (Blueprint $table){
            $table->id();
            $table->float('precioUnitario');
            $table->boolean('activo');
            $table->timestamps();
            $table->unsignedBigInteger('idInsumo');
            $table->foreign('idInsumo')->references('id')->on('insumo');
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
