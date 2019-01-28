<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondivisioniUtentisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condivisioni_utentis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('utente_id');
            $table->unsignedInteger('utente_associato_id');
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
        Schema::dropIfExists('condivisioni_utentis');
    }
}
