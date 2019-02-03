<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->increments('id');
            // Status
            $table->enum('status',[1,2,3]);
            // Policy
            $table->string('code');
            $table->string('group_code')->nullable();
            $table->string('aniversary_date')->nullable();
            $table->string('family_max')->nullable();
            $table->string('family_deductible')->nullable();
            $table->string('individual_maximum')->nullable();
            $table->string('individual_deductible')->nullable();
            $table->string('individual_ortho_maximum')->nullable();
            $table->string('limit_age')->nullable();
            $table->string('limit_age_text')->nullable();
            $table->enum('verified', [1,2,3]);
            // Coverage
            $table->integer('preventivo')->nullable();
            $table->integer('basico')->nullable();
            $table->integer('mayor')->nullable();
            $table->integer('resinas')->nullable();
            $table->integer('endo')->nullable();
            $table->integer('perio')->nullable();
            $table->integer('protesis')->nullable();
            $table->integer('implantes')->nullable();
            $table->integer('ortho')->nullable();
            // Extra Coverage
            $table->string('rayosx')->nullable('(x) cada (x) años');
            $table->string('limpieza')->nullable('x por año');
            $table->string('flour')->nullable('Menores de x años x veces cada x meses.');
            $table->string('coronas')->nullable('Remplazo cada x años');
            $table->string('selladores')->nullable('Menores de x años en primeros y segundos molares permanentes sin restaurar cada x años.');
            $table->string('extracciones_previas')->nullable();
            // Commets
            $table->string('comments')->nullable();

            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('policies');
    }
}
