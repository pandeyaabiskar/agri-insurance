<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->unique();
            $table->integer('area');
            $table->integer('cost');
            $table->string('district');
            $table->string('fromDate');
            $table->string('toDate');
            $table->integer('duration');
            $table->integer('amount');
            $table->integer('lat');
            $table->integer('lon');
            $table->string('facilities');
            $table->string('experience');
            $table->boolean('pastinsurance')->default(0);
            $table->boolean('pastloss')->default(0);
            $table->string('lossDate')->nullable();
            $table->string('lossReason')->nullable();
            $table->integer('lossAmount')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('farmer_id');
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
        Schema::dropIfExists('insurance_applications');
    }
}
