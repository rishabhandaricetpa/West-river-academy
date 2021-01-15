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
            $table->unsignedBigInteger('enrollment_payment_id')->nullable();
            $table->foreign('enrollment_payment_id')->nullable()->references('id')->on('enrollment_payments')->onDelete('cascade');
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
