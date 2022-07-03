<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('project_id')->nullable();
            $table->string('donar_id')->nullable();
            $table->string('email')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->double('amount', 10, 2)->default('0.00');
            $table->double('charge', 10, 2)->default('0.00');
            $table->double('total_amount', 10, 2)->default('0.00');
            $table->string('cname')->nullable();
            $table->string('cnumber')->nullable();
            $table->string('cvv')->nullable();
            $table->string('mm')->nullable();
            $table->string('yy')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
