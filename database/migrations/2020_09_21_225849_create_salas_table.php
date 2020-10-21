<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('sistema_id');
            $table->foreign('sistema_id')->references('id')->on('sistemas')->onDelete('cascade');
        });

        DB::table('salas')->insert([
            'nombre' => 'Sala Guardia Infinita',
            'sistema_id' => 1
        ]);

        DB::table('salas')->insert([
            'nombre' => 'Sala Hotel',
            'sistema_id' => 4
        ]);

        DB::table('salas')->insert([
            'nombre' => 'Sala Domicilio',
            'sistema_id' => 5
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
}
