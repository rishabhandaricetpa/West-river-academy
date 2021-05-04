<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApostilleIdColumnOnNotarizationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notarization_payments', function (Blueprint $table) {
            // $table->unsignedBigInteger('apostille_id');
            $table->foreignId('apostille_id')->nullable()->constrained()->references('id')->on('apostilles');
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
