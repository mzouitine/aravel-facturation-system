<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Adherents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adherents', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('CIN');
            $table->integer('drConsommation');
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('Adresse');
            $table->integer('Tele');
            $table->string('Email');
            $table->integer('Ncompteur');
            $table->string('pvDemande')->nullable();
            $table->string('pvContrat')->nullable();
            $table->string('pvInstalation')->nullable(); 
            $table->string('CINpng')->nullable();
            $table->UnsignedBigInteger('idVillage');
            $table->foreign('idVillage')->references('id')->on('villages');
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
