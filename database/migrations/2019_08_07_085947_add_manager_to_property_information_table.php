<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManagerToPropertyInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_more_information', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('manager_id')->after('property_id')->nullable();
            $table->boolean('isApprovedManager')->after('manager_id')->default(0)->nullable();

            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_more_information', function (Blueprint $table) {
            //
            $table->dropColumn([
                'manager_id',
                'isApprovedManager',
            ]);
        });
    }
}
