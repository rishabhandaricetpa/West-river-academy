<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranscriptIdsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advance_placements', function (Blueprint $table) {
            $table->unsignedBigInteger('transcript_id');
            $table->foreign('transcript_id')->references('id')->on('transcripts')->nullable()->onDelete('cascade');
            $table->unsignedBigInteger('transcript9_12_id');
            $table->foreign('transcript9_12_id')->references('id')->on('transcript9_12')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advance_placements', function (Blueprint $table) {
            //
        });
    }
}
