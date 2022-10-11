<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("telefono", 15)->nullable();
            $table->string("extension", 15)->nullable();
            $table->string("celular", 15)->nullable();
            $table->string("fax", 50)->nullable();
            $table->string("correo")->nullable();
            $table->string("rnc")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
//            $table->foreignId("tipo_id")->type("integer")->constrained();
            $table->unsignedBigInteger("contactoable_id");
            $table->string("contactoable_type");
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
        Schema::dropIfExists('contactos');
    }
}
