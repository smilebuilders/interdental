<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->unsignedInteger('patient_treatment_id');
            $table->foreign('patient_treatment_id')->references('id')->on('patients_treatments')->onDelete('cascade');

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
        Schema::dropIfExists('treatment_images');
    }
}
