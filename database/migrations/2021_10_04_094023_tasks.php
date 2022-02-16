<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',30);
            $table->unsignedBigInteger('importance');
            $table->unsignedBigInteger('urgency');
            $table->unsignedBigInteger('register');
            $table->date('deadline')->index()->nullable();
            $table->string('private')->defalt('public');
            $table->unsignedBigInteger('teamId')->nullable();
            $table->text('detail'); 
            $table->timestamps();

            $table->foreign('teamId')->references('id')->on('teams')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
