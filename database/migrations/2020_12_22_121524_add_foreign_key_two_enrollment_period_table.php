<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTwoEnrollmentPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_periods', function (Blueprint $table) {
            $table->unsignedBigInteger('fee_structure_id');
            $table->foreign('fee_structure_id')->references('id')->on('fee_structures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrollment_periods', function (Blueprint $table) {
            $table->dropForeign('enrollment_periods_fee_structure_id_foreign');
            $table->dropColumn('fee_structure_id');
        });
    }
}
