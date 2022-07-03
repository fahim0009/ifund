<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('college')->nullable();
            $table->string('fundraiser')->nullable();
            $table->string('doner')->nullable();
            $table->string('degree')->nullable();
            $table->string('major_sub')->nullable();
            $table->string('classification')->nullable();
            $table->string('class_schedule')->nullable();
            $table->string('current_gpa')->nullable();
            $table->string('transcript')->nullable();
            $table->string('company')->nullable();
            $table->string('jobtitle')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
