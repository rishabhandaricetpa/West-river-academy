<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_profiles', function (Blueprint $table) {
            $table->string('p2_street_address')->nullable();
            $table->string('p2_city')->nullable();
            $table->string('p2_state')->nullable();
            $table->string('p2_country')->nullable();
            $table->string('p2_zip_code')->nullable();
            $table->string('p2_last_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parent_profiles', function (Blueprint $table) {
            //
        });
    }
}
