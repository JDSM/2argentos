<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->increments('idarticulo');
            $table->integer('idcategoria');
            $table->string('codigo');
            $table->string('nombre');
            $table->float('stock',6,2);
            $table->string('descripcion', 1000);
            $table->string('imagen');
            $table->string('estado');
            $table->timestamps();
            $table->softDeletes(); //agrega una fecha de eliminacion del modelo
            $table->foreign('idcategoria')->references('idcategoria')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo');
    }
}
