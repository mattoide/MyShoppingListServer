<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Referenze extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listas', function (Blueprint $table){
            $table->foreign('utente_id')
                ->references('id')->on('utentes')->onDelete('cascade');
        });

        Schema::table('condivisioni_utentis', function (Blueprint $table){
            $table->foreign('utente_id')
                ->references('id')->on('utentes')->onDelete('cascade'); 
                $table->foreign('utente_associato_id')
                ->references('id')->on('utentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
