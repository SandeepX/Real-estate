<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs-tags', function (Blueprint $table) {

            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');

            $table->foreign('tag_id')->references('id')->on('blog_tags')->onDelete('cascade');

            $table->primary(['blog_id', 'tag_id']);

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
        Schema::dropIfExists('blogs-tags');
    }
}
