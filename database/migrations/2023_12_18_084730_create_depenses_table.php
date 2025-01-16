<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('beneficiaire')->nullable();
            $table->string('motif')->nullable();
            $table->integer('mt')->nullable();
            $table->tinyInteger('sortie_approuve')->nullable();
            $table->integer('nbr_approuve')->nullable();
            $table->integer('id_person_approuve')->nullable();
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
        Schema::dropIfExists('depenses');
    }
}
