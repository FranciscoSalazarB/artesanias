<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticaTiempo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politica_tiempo', function (Blueprint $table) {
            $table->id();
            $table->string('dia');
            $table->tinyInteger('diasRelativosAvisoDePago');
            $table->tinyInteger('diasRelativosAvisoDeConfirmacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('politica_tiempo');
    }
}
