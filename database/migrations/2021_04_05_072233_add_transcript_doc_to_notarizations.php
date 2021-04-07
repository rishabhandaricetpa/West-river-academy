<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranscriptDocToNotarizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notarizations', function (Blueprint $table) {
            $table->string('transcript_doc')->nullable();
            $table->string('confirmation_doc')->nullable();
            $table->string('custom_doc')->nullable();
            $table->string('status')->nullable();
            $table->dropColumn('number_of_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notarizations', function (Blueprint $table) {
        });
    }
}
