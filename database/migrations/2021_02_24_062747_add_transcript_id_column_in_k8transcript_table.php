<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranscriptIdColumnInK8transcriptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('k8transcript', function (Blueprint $table) {
            $table->unsignedBigInteger('transcript_id');
            $table->foreign('transcript_id')->references('id')->on('transcripts')->nullable()->onDelete('cascade');         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('k8transcript', function (Blueprint $table) {
            //
        });
    }
}
