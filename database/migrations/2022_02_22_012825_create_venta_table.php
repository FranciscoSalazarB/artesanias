<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('espera');
            $table->string('referenciaEnvio');
            $table->timestamps();
            $table->dateTime('fechaLimitePago',$precision = 0);
            $table->dateTime('fechaLimiteConfirmar',$precision = 0);
            $table->dateTime('fechaConfirmacion',$precision = 0)->nullable();
            $table->dateTime('fechaCancelacion',$precision = 0)->nullable();
            $table->string('motivo')->nullable();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idDestino');
        });
        Schema::table('venta', function(Blueprint $table){
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
