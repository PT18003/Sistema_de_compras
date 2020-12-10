<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleRequisicion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleRequisicion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('requisicion_id')->unsigned();
            $table->integer('cantidad')->unsigned()->nullable(true);
            $table->char('tipoUnidad', 30)->default('unidad')->nullable(true);
            $table->char('ordenCompra', 8)->nullable(true);
            $table->unsignedBigInteger('id_catalogo')->unsigned();
            $table->integer('estado_req')->default('0');
            $table->unsignedBigInteger('id_articuloProveedor')->unsigned()->nullable(true);
            $table->foreign('requisicion_id')->references('id')->on('requisiciones');
            $table->foreign('id_catalogo')->references('id')->on('catalogos');
            $table->foreign('id_articuloProveedor')->references('id')->on('articulos_proveedores');
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
        //
    }
}
