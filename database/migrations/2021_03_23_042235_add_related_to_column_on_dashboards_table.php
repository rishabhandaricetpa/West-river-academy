<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelatedToColumnOnDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dashboards', function (Blueprint $table) {
            $table->string('related_to')->nullable();
            // $table->unsignedBigInteger('student_profile_id');
            $table->foreignId('student_profile_id')->nullable()->constrained()->references('id')->on('student_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('column_on_dashboards', function (Blueprint $table) {
            //
        });
    }
}
