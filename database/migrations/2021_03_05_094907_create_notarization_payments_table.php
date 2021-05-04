<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotarizationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notarization_payments', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('notarization_id');
            $table->foreignId('notarization_id')->nullable()->constrained()->references('id')->on('notarizations');
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->string('pay_for');
            $table->string('amount');
            $table->enum('status', ['pending', 'paid', 'approved', 'completed']);
            $table->string('transcation_id')->nullable();
            $table->string('payment_mode')->nullable();
            // $table->unsignedBigInteger('order_postages_id');
            // $table->foreign('order_postages_id')->references('id')->on('order_postages')->nullable()->onDelete('cascade');
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
        Schema::dropIfExists('notarization_payments');
    }
}
