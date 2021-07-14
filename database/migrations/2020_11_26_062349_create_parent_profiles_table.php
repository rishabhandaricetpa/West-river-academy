<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('p1_first_name')->nullable();
            $table->string('p1_middle_name')->nullable();
            $table->string('p1_last_name')->nullable();
            $table->string('p1_email')->nullable();
            $table->string('p1_cell_phone');
            $table->string('p1_home_phone')->nullable();
            $table->string('p2_first_name')->nullable();
            $table->string('p2_middle_name')->nullable();
            $table->string('legacy')->nullable();
            $table->string('p2_email')->nullable();
            $table->string('p2_cell_phone')->nullable();
            $table->string('p2_home_phone')->nullable();
            $table->string('street_address');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('p2_street_address')->nullable();
            $table->string('p2_city')->nullable();
            $table->string('p2_state')->nullable();
            $table->string('p2_zip_code')->nullable();
            $table->string('p2_country')->nullable();
            $table->string('reference', 5000)->nullable();
            $table->string('immunized')->nullable();
            $table->boolean('status')->default('0');
            $table->string('p2_last_name')->nullable();
            $table->boolean('welcome_video_status')->default('0');
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
        Schema::dropIfExists('parent_profiles');
    }
}
