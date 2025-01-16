<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrees', function (Blueprint $table) {
            $table->id();
            $table->string('source')->nullable();
            $table->string('beneficiaire')->nullable();
            $table->string('motif')->nullable();
            $table->date('date')->nullable();
            $table->integer('mt_d')->nullable();
            $table->string('description')->nullable();
            $table->integer('mt_a')->nullable();
            $table->string('remarque')->nullable();
            $table->string('type_paye')->nullable();
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
        Schema::dropIfExists('entrees');
    }
}
