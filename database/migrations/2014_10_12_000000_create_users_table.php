<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // Don't ask that's some shitty naming sense (in french lol)
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('mdp');
            $table->string('role')->nullable();
            $table->string('user')->nullable();
            $table->string('actions_entrees')->nullable();
            $table->string('actions_depenses')->nullable();
            $table->string('actions_besoins')->nullable();
            $table->string('actions_statistiques')->nullable();
            $table->string('menu_source')->nullable();
            $table->string('menu_benef')->nullable();
            $table->string('menu_motif')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
