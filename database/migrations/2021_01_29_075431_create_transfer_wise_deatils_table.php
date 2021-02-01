<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferWiseDeatilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_wise_deatils', function (Blueprint $table) {
            $table->id();
            $table->string('account_holder');
            $table->string('account_number');
            $table->string('wire_transfer_number');
            $table->string('swift_code');
            $table->string('routing_number');
            $table->string('address');
            $table->string('state');
            $table->string('country');
            $table->string('website');
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
        Schema::dropIfExists('transfer_wise_deatils');
    }
}
