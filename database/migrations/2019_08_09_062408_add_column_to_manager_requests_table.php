<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToManagerRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manager_requests', function (Blueprint $table) {
            //
            $table->boolean('isCompleted')->after('request_type')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manager_requests', function (Blueprint $table) {
            //
            $table->dropColumn([
                'isCompleted',
            ]);
        });
    }
}
