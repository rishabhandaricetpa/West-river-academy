<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('swift_code');
            $table->string('bank_address');
            $table->string('street');
            $table->string('phone_number');
            $table->string('routing_number');
            $table->string('account_name');
            $table->string('account_number');
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('bank_transfer_details');
    }
}
