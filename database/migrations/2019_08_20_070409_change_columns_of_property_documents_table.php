<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsOfPropertyDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_documents', function (Blueprint $table) {
            //
            $table->text('lal_purja')->after('property_id')->nullable();
            $table->text('ghar_naksa')->after('lal_purja')->nullable();
            $table->text('trace_naksa')->after('ghar_naksa')->nullable();
            $table->text('blueprint')->after('trace_naksa')->nullable();
            $table->text('charkilla')->after('blueprint')->nullable();
            $table->text('tax_receipt')->after('charkilla')->nullable();
        });

        Schema::table('property_documents', function (Blueprint $table) {
            $table->dropColumn(['document']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_documents', function (Blueprint $table) {
            //
            $table->dropColumn([
                'lal_purja',
                'ghar_naksa',
                'trace_naksa',
                'blueprint',
                'charkilla',
                'tax_receipt',
            ]);
        });
    }
}
