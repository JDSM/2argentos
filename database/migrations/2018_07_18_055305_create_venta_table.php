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
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('idventa');
            $table->string('tipo_comprobante',20);
            $table->string('estado',20);
            $table->string('responsable',20);
            $table->string('serie_comprobante',20);
            $table->string('num_comprobante',20);
            $table->float('impuesto',6,2)->unsigned();
            $table->float('total_venta',6,2)->unsigned();
            $table->integer('idcliente')->unsigned();
            $table->timestamps('fecha_hora');
            $table->softDeletes();
            $table->foreign('idcliente')->references('idpersona')->on('persona');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
