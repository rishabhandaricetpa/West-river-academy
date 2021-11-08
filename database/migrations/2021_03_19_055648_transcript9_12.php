<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transcript912 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcript9_12', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_profile_id');
            $table->foreign('student_profile_id')->references('id')->on('student_profiles')->nullable()->onDelete('cascade');
            $table->string('country')->nullable();
            $table->boolean('is_carnegie')->nullable();
            $table->string('enrollment_year')->nullable();
            $table->string('grade')->nullable();
            $table->string('school_name')->nullable();
            $table->unsignedBigInteger('transcript_id');
            $table->boolean('is_archieved')->nullable();
            $table->foreign('transcript_id')->references('id')->on('transcripts')->nullable()->onDelete('cascade');
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
        Schema::dropIfExists('transcript9_12');
    }
}
