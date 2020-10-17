<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sistemas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });
        

        DB::table('sistemas')->insert([
            'nombre' => 'Guardia'
        ]);
        DB::table('sistemas')->insert([
            'nombre' => 'Piso Covid'
        ]);
        DB::table('sistemas')->insert([
            'nombre' => 'Unidad Terapia Intensiva'
        ]);
        DB::table('sistemas')->insert([
            'nombre' => 'Hotel'
        ]);
        DB::table('sistemas')->insert([
            'nombre' => 'Domicilio'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sistemas');
    }
}
