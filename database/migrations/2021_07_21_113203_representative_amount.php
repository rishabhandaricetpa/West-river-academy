<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RepresentativeAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('representative_amount', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('representative_group_id');
            $table->foreign('representative_group_id')->references('id')->on('representative_groups')->onDelete('cascade');
            $table->string('amount')->nullable();
            $table->longText('notes')->nullable();
            $table->enum('status', ['pending', 'paid'])->nullable();
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
        //
    }
}
