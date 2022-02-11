<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_verifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('application_id')->unique();
            $table->string('fruit');
            $table->string('species');
            $table->integer('area');
            $table->integer('cost');
            $table->string('facilities');
            $table->boolean('condition');
            $table->boolean('disease');
            $table->string('disease_description')->nullable();
            $table->boolean('care');
            $table->boolean('future_disease');
            $table->string('risk')->nullable();
            $table->boolean('status');
            $table->integer('riskmanager_id');
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
        Schema::dropIfExists('insurance_verifications');
    }
}
