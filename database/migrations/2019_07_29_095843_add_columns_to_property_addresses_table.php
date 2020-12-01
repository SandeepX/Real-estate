<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPropertyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_addresses', function (Blueprint $table) {

            $table->unsignedBigInteger('province_id')->after('property_id')->nullable();
            $table->unsignedBigInteger('district_id')->after('province_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->after('district_id')->nullable();


            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('municipality_id')->references('id')->on('municipals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_addresses', function (Blueprint $table) {
            //
            $table->dropColumn([
                'province_id',
                'district_id',
                'municipality_id',
            ]);
        });
    }
}
