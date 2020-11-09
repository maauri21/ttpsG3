<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internacions', function (Blueprint $table) {
            $table->id();
            $table->date('fIniciosintomas');
            $table->date('fDiagnosticocovid');
            $table->text('descripcion');
            $table->date('fInternacion');
            $table->date('fObito')->nullable();
            $table->date('fAlta')->nullable();
            $table->text('descripcionAlta')->nullable();
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internacions');
    }
}
