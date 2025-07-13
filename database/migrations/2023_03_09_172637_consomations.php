<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Consomations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consomations', function (Blueprint $table) {
            $table->integer('N_con')->primary();
            $table->double('consomation_Total');
            $table->double('consomation_Tranch');
            $table->double('montant');
            $table->date('dateTour');
            $table->integer('N_contrat')->nullable();
            $table->foreign('N_contrat')->references('N_Co')->on('adherents');
            
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
        //
    }
}
