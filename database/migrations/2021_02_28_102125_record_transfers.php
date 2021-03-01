<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecordTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_profile_id');
            $table->foreign('student_profile_id')->references('id')->on('student_profiles')->nullable()->onDelete('cascade');
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->string('school_name')->nullable();
            $table->string('email');
            $table->string('fax_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->enum('status', ['InReview', 'approved', 'completed']);
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
        Schema::dropIfExists('record_transfers');
    }
}
