<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besoins', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->nullable();
            $table->integer('montant')->nullable();
            $table->integer('montant_accorde')->nullable();
            $table->integer('payement')->nullable();
            $table->string('status')->nullable();
            $table->date('date')->nullable();
            $table->date('date_approv')->nullable();
            $table->string('auteur')->nullable();
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
        Schema::dropIfExists('besoins');
    }
}
