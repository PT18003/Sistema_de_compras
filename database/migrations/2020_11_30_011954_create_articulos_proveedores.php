<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos_proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_catalogo')->unsigned();
            $table->bigInteger('id_proveedor')->unsigned();
            $table->string('codigoArticulo',10)->nullable(true);//de tipo string y que no acepte valores nulos
            //$table->string('descripcionRol',100)->nullable(true);
            $table->date('fechaInicio')->nullable(true);
            $table->date('fechaFinal')->nullable(true);
            $table->decimal('precio',6,2)->nullable(true);
            //$table->string('periodoPago')->nullable(true);
            $table->decimal('descuento',6,2)->nullable(true);

            $table->foreign('id_catalogo')->references('id')->on('catalogos');
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
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
        Schema::dropIfExists('articulos_proveedores');
    }
}
