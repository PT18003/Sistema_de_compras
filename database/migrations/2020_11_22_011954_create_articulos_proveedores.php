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
            $table->string('codigoArticulo',10)->nullable(false);//de tipo string y que no acepte valores nulos
            $table->string('descripcionRol',100)->nullable(false);
            $table->date('fechaInicio');
            $table->date('fechaFinal');
            $table->decimal('precio',6,2)->nullable(false);
            $table->string('periodoPago')->nullable(false);
            $table->decimal('descuento',6,2)->nullable(false);
            $table->time('tiempoEntrega');
            $table->timestamps();
            $table->softDeletes(); 

            $table->foreign('id_catalogo')->references('id')->on('catalogos');
            $table->foreign('id_proveedor')->references('id')->on('proveedores');

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
