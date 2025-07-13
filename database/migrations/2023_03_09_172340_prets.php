<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prets', function (Blueprint $table) {
            $table->integer('id_p')->primary();
            $table->double('pret');
            $table->integer('N_contrat')->nullable();
            $table->foreign('N_contrat')->references('N_Co')->on('adherents');

           
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
