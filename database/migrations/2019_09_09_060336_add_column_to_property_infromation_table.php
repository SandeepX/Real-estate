<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPropertyInfromationTable extends Migration
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
            $table->string('ref_owner_name_1')->after('owner_contact')->nullable();
            $table->string('ref_owner_phone_1')->after('ref_owner_name_1')->nullable();
            $table->string('ref_owner_name_2')->after('ref_owner_phone_1')->nullable();
            $table->string('ref_owner_phone_2')->after('ref_owner_name_2')->nullable();
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
                'ref_owner_name_1',
                'ref_owner_phone_1',
                'ref_owner_name_2',
                'ref_owner_phone_2'
            ]);
        });
    }
}
