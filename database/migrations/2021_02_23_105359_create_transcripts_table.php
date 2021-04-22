<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcripts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->unsignedBigInteger('student_profile_id');
            $table->foreign('student_profile_id')->references('id')->on('student_profiles')->onDelete('cascade');
            $table->string('legacy_name')->nullable();
            $table->string('period');
            $table->string('transcript_wiz')->nullable();
            $table->enum('status', ['pending', 'approved', 'paid', 'completed', 'canEdit']);
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
        Schema::dropIfExists('transcripts');
    }
}
