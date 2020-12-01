<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsOfReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_reviews', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('user_id')->after('property_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('property_reviews', function (Blueprint $table) {
            $table->dropColumn(['client_name', 'client_email','client_image','client_location',
                'client_phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_reviews', function (Blueprint $table) {
            //
            $table->dropColumn([
                'user_id',
            ]);
        });
    }
}
