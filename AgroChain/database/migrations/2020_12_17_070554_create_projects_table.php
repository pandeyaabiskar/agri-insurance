<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pid');
            $table->string('name');
            $table->string('fruit');
            $table->string('species');
            $table->longText('description');
            $table->integer('units');
            $table->integer('price');
            $table->string('season');
            $table->integer('duration');
            $table->boolean('status')->default(1);
            $table->string('filename')->default('project.jpg');
            $table->integer('farmer_id');
            $table->integer('balance')->default(0);
            $table->integer('contributors')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
