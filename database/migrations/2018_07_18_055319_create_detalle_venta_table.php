<?php
use App\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->increments('iddetalle_venta');
            $table->integer('cantidad')->unsigned();
            $table->float('precio_venta',6,2)->unsigned();
            $table->float('descuento',6,2)->unsigned();
            $table->integer('idventa')->unsigned();
            $table->integer('idarticulo')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('idventa')->references('idventa')->on('venta');
            $table->foreign('idarticulo')->references('idarticulo')->on('articulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_venta');
    }
}
