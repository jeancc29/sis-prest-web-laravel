<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companias', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre")->nullable();
            $table->integer("estado")->default(1);
            $table->integer("diasGracia")->nullable();
            $table->decimal("porcentajeMora", 10, 2)->nullable(); //porcentajeMora
//            $table->unsignedInteger("compania_id");
            $table->foreignId("tipo_id_mora")->type("integer")->constrained();
            $table->text("direccion")->nullable();
//            $table->foreignId("contacto_id")->nullable()->type("integer")->constrained();
            $table->foreignId("moneda_id")->type("integer")->constrained();
            $table->foreignId("nacionalidad_id")->type("integer")->constrained();
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
        Schema::dropIfExists('companias');
    }
}
