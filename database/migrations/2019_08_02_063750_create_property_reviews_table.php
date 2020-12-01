<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_reviews', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('client_name');
            $table->bigInteger('property_id')->unsigned()->nullable();
            $table->string('client_email')->nullable();
            $table->text('client_message');
            $table->string('client_location')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_image')->nullable();
            $table->integer('client_rating')->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_reviews');
    }
}
