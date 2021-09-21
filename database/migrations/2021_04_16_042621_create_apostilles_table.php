<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApostillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apostilles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_profile_id')->nullable()->constrained()->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->string('number_of_documents');
            $table->string('additional_message')->nullable();
            $table->string('postage_option');
            $table->string('apostille_country')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('status')->nullable();
            $table->string('transcript_doc')->nullable();
            $table->string('confirmation_doc')->nullable();
            $table->string('custom_doc')->nullable();
            $table->dropColumn('number_of_documents');
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
        Schema::dropIfExists('apostilles');
    }
}
