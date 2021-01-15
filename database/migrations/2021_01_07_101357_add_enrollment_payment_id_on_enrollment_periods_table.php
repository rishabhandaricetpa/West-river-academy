<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnrollmentPaymentIdOnEnrollmentPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_periods', function (Blueprint $table) {
            $table->unsignedBigInteger('enrollment_payment_id');
            $table->foreign('enrollment_payment_id')->references('id')->on('enrollment_payments')->onDelete('cascade')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
