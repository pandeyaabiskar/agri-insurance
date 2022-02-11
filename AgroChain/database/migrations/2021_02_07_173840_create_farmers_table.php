<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('farm_name');
            $table->string('farm_location');
            $table->string('farm_contact')->unique();
            $table->string('registration')->unique();
            $table->integer('size');
            $table->string('description');
            $table->integer('verified')->default('0');
            $table->integer('updated')->default('0');
            $table->string('filename')->default('farm.jpg');
            $table->integer('user_id');
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
        Schema::dropIfExists('farmers');
    }
}
