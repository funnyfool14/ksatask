<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Requests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId');
            $table->unsignedInteger('check')->defalt('0');
            $table->string('projectName',30)->nullable();
            $table->unsignedBigInteger('projectManager')->nullable();
            $table->date('projectDeadline')->nullable();
            $table->text('projectDetail')->nullable();
            $table->string('teamName',30)->nullable();
            $table->unsignedBigInteger('teamLeader')->nullable();
            $table->unsignedBigInteger('teamDepty')->nullable();
            $table->date('taskDeadline')->nullable();
            $table->unsignedBigInteger('inCharge')->nullable();
            $table->text('taskDetail'); 

            $table->timestamps();

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
        Schema::dropIfExists('requests');
    }
}
