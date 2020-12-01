<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyMoreInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_more_information', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('owner_name');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('property_id')->unsigned();
            $table->string('owner_address')->nullable();
            $table->string('owner_contact')->nullable();
            $table->text('yt_url')->nullable();
            $table->string('yt_title')->nullable();
            $table->text('private_note')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('property_more_information');
    }
}
