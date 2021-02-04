<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrollment_period_id');
            $table->foreign('enrollment_period_id')->references('id')->on('enrollment_periods')->onDelete('cascade');
            $table->string('amount');
            $table->enum('status', ['pending', 'paid', 'active']);
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
        Schema::dropIfExists('enrollment_payments');
    }
}
