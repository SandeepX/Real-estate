<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyFloorPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_floor_plans', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('floor_title');
            $table->bigInteger('property_id')->unsigned();

            $table->longText('floor_description')->nullable();
            $table->integer('floor_price')->nullable();
            $table->string('floor_price_postfix')->nullable();
            $table->integer('floor_area_size')->nullable();
            $table->string('floor_area_size_postfix')->nullable();

            $table->integer('floor_bedrooms')->nullable();
            $table->integer('floor_bathrooms')->nullable();

            $table->string('floor_image')->nullable();
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_floor_plans');
    }
}
