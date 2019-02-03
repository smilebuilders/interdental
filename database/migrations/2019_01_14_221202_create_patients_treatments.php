<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->nullable();
            $table->string('sc')->nullable();
            $table->string('df')->nullable();
            $table->string('code');
            $table->string('description');
            $table->string('status')->default('');
            $table->string('images')->nullable();
            $table->string('date');
            $table->timestamps();

            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->unsignedInteger('claim_id')->nullable();
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients_treatments');
    }
}
