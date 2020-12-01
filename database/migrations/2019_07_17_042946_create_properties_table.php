<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('property_id')->unique();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->bigInteger('property_category_id')->unsigned()->nullable();
            $table->bigInteger('property_subcategory_id')->unsigned()->nullable();
            $table->bigInteger('property_status_id')->unsigned()->nullable();
            $table->boolean('status')->nullable();

            $table->longText('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('price_postfix')->nullable();
            $table->integer('area_size')->nullable();
            $table->string('area_size_postfix')->nullable();
            $table->integer('lot_size')->nullable();
            $table->string('lot_size_postfix')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('garages')->nullable();
            $table->string('year_built')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('isFeatured')->nullable();
            $table->text('additional_features')->nullable();
            $table->unsignedBigInteger('view_count')->nullable();
            $table->timestamps();

            $table->foreign('property_category_id')->references('id')->on('property_categories')->onDelete('cascade');
            $table->foreign('property_subcategory_id')->references('id')->on('property_sub_categories')->onDelete('cascade');

            $table->foreign('property_status_id')->references('id')->on('property_statuses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
