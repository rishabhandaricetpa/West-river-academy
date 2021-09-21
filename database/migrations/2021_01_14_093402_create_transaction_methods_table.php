<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transcation_id');
            $table->string('payment_mode');
            $table->unsignedBigInteger('parent_profile_id');
            $table->foreign('parent_profile_id')->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->timestamps();
            $table->string('amount');
            $table->string('status')->nullable();
            $table->string('item_type')->nullable();
            $table->string('student_profile_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_methods');
    }
}
