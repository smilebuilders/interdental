<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('status')->default('pending');
            $table->string('address')->default('INTERDENTAL SOLUTIONS INC/Ricardo J. Guevara DDS \n P.O.Box 181100 \n CORONADO, CA 92178');
            $table->string('npi')->default('1740792902');
            $table->string('ssn')->default('82-2382876');
            $table->string('type_of_transaction')->nullable();
            $table->string('remarks')->nullable();
            $table->string('nea')->nullable();
            $table->string('number_enclosures')->nullable();
            $table->string('is_ortho')->default('false');
            $table->string('is_ortho_date')->nullable();
            $table->string('remaining')->nullable();
            $table->string('replacement_prosthesis')->default('false');
            $table->string('placement_date')->nullable();
            $table->timestamps();

            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
