<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastoPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("prestamo_id")->constrained();
            $table->foreignId("tipo_id")->type("integer")->constrained();
            $table->double("porcentaje", 5, 2);
            $table->decimal("importe", 15, 2);
            $table->boolean("incluirEnElFinanciamiento")->default(0);
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
        Schema::dropIfExists('gasto_prestamos');
    }
}
