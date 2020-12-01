<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //table category,subcategory for the property
        Schema::create('category_subcategory', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');

            $table->foreign('category_id')->references('id')->on('property_categories')->onDelete('cascade');

            $table->foreign('subcategory_id')->references('id')->on('property_sub_categories')->onDelete('cascade');

            $table->primary(['category_id', 'subcategory_id']);

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
        Schema::dropIfExists('category_subcategory');
    }
}
