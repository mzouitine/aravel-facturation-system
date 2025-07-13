<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Factures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->integer('N_fac')->primary();
            $table->double('PrixFact');
            $table->date('dernire_datePayment');
            $table->integer('consomation');
            $table->integer('N_contrat');
            $table->foreign('N_contrat')->references('N_Co')->on('adherents');
            $table->integer('Id_pret')->nullable();
            $table->foreign('Id_pret')->references('id_p')->on('prets');
            $table->string('village', 100);
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
