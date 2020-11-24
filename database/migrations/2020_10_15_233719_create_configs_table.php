<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->boolean('camasinfinitas');
            $table->boolean('somnolencia');
            $table->boolean('mecven');
            $table->boolean('iniciosint');
            $table->boolean('satuo2');
            $table->integer('valor_sato2');
        });

        DB::table('configs')->insert([
            'camasinfinitas' => True,
            'somnolencia' => True,
            'mecven' => True,
            'iniciosint' => True,
            'satuo2' => True,
            'valor_sato2' => 92,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
