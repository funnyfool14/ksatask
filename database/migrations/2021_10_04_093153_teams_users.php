<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeamsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamsUsers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teamId');
            $table->unsignedBigInteger('userId');
            $table->timestamps();

            $table->foreign('teamId')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teamsUsers');
    }
}
