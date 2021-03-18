<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentProfileIdColumnOnTranscriptPdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transcript_pdf', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->nullable()->references('id')->on('parent_profiles')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
