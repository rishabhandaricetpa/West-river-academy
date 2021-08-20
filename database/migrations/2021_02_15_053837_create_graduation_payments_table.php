<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduation_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('graduation_id');
            $table->foreign('graduation_id')->references('id')->on('graduations')->onDelete('cascade');
            $table->string('amount');
            $table->string('transcation_id')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('order_id')->nullable();
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
        Schema::dropIfExists('graduation_payments');
    }
}
