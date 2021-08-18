<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('created_date')->nullable();
            $table->string('updated_date')->nullable();
            $table->string('linked_to')->nullable();
            $table->string('amount')->nullable();
            $table->string('related_to')->nullable();
            $table->foreignId('student_profile_id')->nullable()->constrained()->references('id')->on('student_profiles')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('dashboards');
    }
}
