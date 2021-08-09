<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_profile_id');
            // $table->foreign('parent_profile_id')->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->foreignId('parent_profile_id')->nullable()->constrained()->references('id')->on('parent_profiles')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('rep_phone')->nullable();
            $table->string('rep_skype')->nullable();
            $table->string('terms_of_agreement', 5000)->nullable();
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
        Schema::dropIfExists('representative_groups');
    }
}
