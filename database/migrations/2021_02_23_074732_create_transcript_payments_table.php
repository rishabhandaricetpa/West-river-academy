<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscriptPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcript_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_profile_id');
            $table->foreign('student_profile_id')->references('student_profile_id')->on('k8transcript')->nullable()->onDelete('cascade');
            $table->string('amount');
            $table->enum('status', ['pending', 'paid', 'approved','completed']);
            $table->string('transcation_id')->nullable();
            $table->string('payment_mode')->nullable();
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
        Schema::dropIfExists('transcript_payments');
    }
}
