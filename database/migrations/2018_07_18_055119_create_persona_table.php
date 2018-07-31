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
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('idpersona');
            $table->string('tipo_persona',20);
            $table->string('nombre', 100);
            $table->string('tipo_documento',20);
            $table->string('num_documento',15);
            $table->string('direccion',70);
            $table->string('telefono',15);
            $table->string('email',50);
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
        Schema::dropIfExists('persona');
    }
}
