<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicions', function (Blueprint $table) {
            $table->bigIncrements('id_requisicion');
            $table->dateTime('fecha_aceptado');
            $table->unsignedBigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('Catalogos');
            $table->unsignedBigInteger('descripcion_id')->unsigned();
            $table->foreign('descripcion_id')->references('id')->on('Catalogos');
            $table->unsignedBigInteger('creado_id')->unsigned();
            $table->foreign('creado_id')->references('id')->on('Empleados');
            $table->unsignedBigInteger('aceptado_id')->unsigned();
            $table->unsignedBigInteger('encargado_id')->unsigned();
            $table->foreign('aceptado_id')->references('id')->on('Empleados');
            $table->foreign('encargado_id')->references('id')->on('Empleados');
            $table->string('estado_req');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisicions');
    }
}
