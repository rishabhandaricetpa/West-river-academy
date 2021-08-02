<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_profile_id')->nullable()->constrained()->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->foreignId('student_profile_id')->nullable()->constrained()->references('id')->on('student_profiles')->onDelete('cascade');
            $table->foreignId('representative_group_id')->nullable()->constrained()->references('id')->on('representative_groups')->onDelete('cascade');
            $table->string('notes', 3000)->nullable();
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
        Schema::dropIfExists('notes');
    }
}
