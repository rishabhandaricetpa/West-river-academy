<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representative_group_id')->nullable()->constrained()->references('id')->on('representative_groups')->onDelete('cascade');
            $table->string('original_filename');
            $table->string('document_type', 5000)->nullable();
            $table->string('filename');
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
        Schema::dropIfExists('representative_documents');
    }
}
