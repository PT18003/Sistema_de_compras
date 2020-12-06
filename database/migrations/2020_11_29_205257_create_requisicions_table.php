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
        Schema::create('requisiciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fechaAceptada')->nullable(true);
            $table->unsignedBigInteger('creado_id')->unsigned();
            $table->unsignedBigInteger('aceptado_id')->nullable(true)->unsigned();
            $table->unsignedBigInteger('encargado_id')->nullable(true)->unsigned();
            $table->integer('estado_req')->default('0');
            $table->foreign('creado_id')->references('id')->on('Empleados');
            $table->foreign('aceptado_id')->references('id')->on('Empleados');
            $table->foreign('encargado_id')->references('id')->on('Empleados');
            $table->timestamps();
            $table->softDeletes(); 
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
