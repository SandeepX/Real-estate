<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
           // $table->string('email')->nullable()->change();
            //$table->string('password')->nullable()->change();
            $table->unsignedBigInteger('province_id')->after('password')->nullable();
            $table->unsignedBigInteger('district_id')->after('province_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->after('district_id')->nullable();
            $table->string('token')->nullable();
            $table->text('fb_id')->after('municipality_id')->nullable();
            $table->text('google_id')->after('fb_id')->nullable();
            $table->text('provider')->after('google_id')->nullable();
            $table->text('provider_id')->after('provider')->nullable();

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipals')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'province_id',
                'district_id',
                'municipality_id',
                'fb_id',
                'google_id',
                'provider',
                'provider_id',

            ]);
        });
    }
}
