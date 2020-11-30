<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InternacionSistema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internacion_sistema', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internacion_id');
            $table->unsignedBigInteger('sistema_id');
            $table->date('inicio');
            $table->date('fin')->nullable();
            $table->foreign('internacion_id')->references('id')->on('internacions')->onDelete('cascade');
            $table->foreign('sistema_id')->references('id')->on('sistemas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internacion_sistema');
    }
}
