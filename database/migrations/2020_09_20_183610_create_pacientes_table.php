<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->integer('dni')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccion');
            $table->integer('telefono');
            $table->date('fnac');
            $table->string('email');
            $table->string('obrasocial')->nullable();
            $table->text('antecedentes')->nullable();
            $table->unsignedInteger('contacto_id')->nullable();
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
        Schema::dropIfExists('pacientes');
    }
}
