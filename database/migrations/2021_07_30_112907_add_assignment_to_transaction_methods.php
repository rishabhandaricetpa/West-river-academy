<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignmentToTransactionMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_methods', function (Blueprint $table) {
            $table->string('notes')->nullable();
            $table->string('assigned_to')->nullable();
            $table->boolean('is_archieved')->nullable();
            $table->string('task_status')->nullable();
            $table->string('is_completed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_methods', function (Blueprint $table) {
            //
        });
    }
}
