<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_reviews', function (Blueprint $table) {

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('blog_id')->unsigned()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('client_message');
            $table->integer('client_rating')->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_reviews');
    }
}
