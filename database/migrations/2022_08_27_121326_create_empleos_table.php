<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleos', function (Blueprint $table) {
            $table->bigIncrements("id");

            $table->string("nombre");
            $table->string("ocupacion");
            $table->decimal("ingresos", 20, 2);
            $table->decimal("otrosIngresos", 20, 2);
            $table->date("fechaIngreso");
            $table->unsignedInteger("compania_id")->nullable();
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
        Schema::dropIfExists('empleos');
    }
}
