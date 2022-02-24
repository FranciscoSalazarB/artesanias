<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_lineas', function (Blueprint $table) {
            $table->id();
            $table->string('folioVenta');
            $table->float('costoEnvio');
            $table->dateTime('fechaEnvio');
            $table->dateTime('fechaRegistro');
            $table->dateTime('fechaReciboComprador');
            $table->timestamps();
            $table->unsignedBigInteger('idUSer');
            $table->foreign('idUser')->references('id')->on('users');
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
