<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolucions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');

            $table->float('temperatura');
            $table->integer('tasistolica');
            $table->integer('tadiastolica');
            $table->integer('fc');
            $table->integer('fr');

            $table->string('mecanicaventilatoria')->nullable();
            $table->boolean('o2suplementario');
            $table->float('canulanasal')->nullable();
            $table->float('mascarares')->nullable();
            $table->integer('sato2')->nullable();
            $table->boolean('pafi');
            $table->integer('valorpafi')->nullable();
            $table->boolean('pronovigil');
            $table->boolean('tos');
            $table->string('disnea')->nullable();
            $table->boolean('desaresp');

            $table->boolean('somnolencia');
            $table->boolean('anosmia');
            $table->boolean('disgeusia');

            $table->boolean('rxtx');
            $table->string('tiporxtx')->nullable();
            $table->string('descripcionrx')->nullable();
            $table->boolean('tactorax');
            $table->string('tipotactorax')->nullable();
            $table->string('descripciontactorax')->nullable();
            $table->boolean('ecg');
            $table->string('tipoecg')->nullable();
            $table->string('descripcionecg')->nullable();
            $table->boolean('pcr');
            $table->string('tipopcr')->nullable();
            $table->string('descripcionpcr')->nullable();

            $table->string('descripcionobs');

            $table->string('arm')->nullable();
            $table->string('descripcionArm')->nullable();
            $table->string('traqueostomia')->nullable();
            $table->string('vasopresores')->nullable();
            $table->string('descripcionVasop')->nullable();

            $table->string('textoAlerta')->nullable();
            $table->integer('paciente_alerta')->nullable();

            $table->unsignedBigInteger('internacion_id');
            $table->foreign('internacion_id')->references('id')->on('internacions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolucions');
    }
}
