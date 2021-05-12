<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmation_letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_profile_id');
            $table->foreign('student_profile_id')->references('id')->on('student_profiles')->nullable()->onDelete('cascade');
            $table->string('pdf_link')->nullable();
            $table->enum('status', ['pending', 'paid', 'completed','active']);
            $table->unsignedBigInteger('enrollment_period_id');
            $table->foreign('enrollment_period_id')->references('id')->on('enrollment_periods')->onDelete('cascade');
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
        Schema::dropIfExists('confirmation_letters');
    }
}
