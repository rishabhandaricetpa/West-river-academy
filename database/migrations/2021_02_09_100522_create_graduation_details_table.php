<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGraduationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('graduation_id');
            $table->foreign('graduation_id')->references('id')->on('graduations')->onDelete('cascade');
            $table->string('project')->nullable();
            $table->string('diploma')->nullable();
            $table->string('transcript')->nullable();
            $table->longText('situation')->nullable();
            $table->string('record_received')->nullable();
            $table->date('grad_date')->nullable();
            $table->string('apostille_package')->nullable();
            $table->longText('notes')->nullable();

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
        Schema::dropIfExists('graduation_details');
    }
}
