<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPersonalConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_personal_consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->string('preferred_language');
            $table->string('en_call_type')->nullable();
            $table->string('sp_call_type')->nullable();
            $table->string('amount');
            $table->string('consulting_about')->nullable();
            $table->string('paying_for');
            $table->string('type_of_payment');
            $table->string('transcation_id')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('order_personal_consultation');
    }
}
