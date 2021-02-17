<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->references('id')->on('parent_profiles');
            $table->unsignedBigInteger('student_profile_id');
            $table->foreign('student_profile_id')->references('id')->on('student_profiles');
            $table->string('grade_9_info');
            $table->string('grade_10_info');
            $table->string('grade_11_info');
            $table->enum('status', ['pending', 'approved', 'paid', 'completed']);
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
        Schema::dropIfExists('graduations');
    }
}
