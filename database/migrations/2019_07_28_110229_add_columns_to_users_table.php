<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
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
            $table->text('facebook')->after('user_image')->nullable();
            $table->text('instagram')->after('facebook')->nullable();
            $table->text('twitter')->after('instagram')->nullable();
            $table->text('linkedin')->after('twitter')->nullable();
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
                'facebook',
                'instagram',
                'twitter',
                'linkedin',
            ]);
        });
    }
}
