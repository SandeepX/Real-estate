<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifiedToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->enum('verify_status',['verified','pending','unverified'])->after('status')->default('unverified')->nullable();
            $table->timestamp('verified_at')->after('verify_status')->nullable();

            $table->enum('feature_status',['featured','pending','unfeatured'])->after('verified_at')->default('unfeatured')->nullable();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['isFeatured']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->dropColumn([
                'verify_status',
                'verified_at',
                'feature_status',
            ]);
        });
    }
}
