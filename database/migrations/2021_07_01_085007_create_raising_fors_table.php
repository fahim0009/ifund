<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaisingForsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raising_fors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fundraiser_id')->unsigned()->nullable();
            $table->foreign('fundraiser_id')->references('id')->on('fundraisers')->onDelete('cascade');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('raising_fors');
    }
}
