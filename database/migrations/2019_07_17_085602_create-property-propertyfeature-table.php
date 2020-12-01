<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPropertyfeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_propertyfeature', function (Blueprint $table) {

            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('feature_id');

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');

            $table->foreign('feature_id')->references('id')->on('property_features')->onDelete('cascade');

            $table->primary(['property_id', 'feature_id']);

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
        Schema::dropIfExists('property-propertyfeature');
    }
}
