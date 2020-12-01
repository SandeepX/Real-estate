<?php

use Illuminate\Database\Seeder;


class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('site_settings')->insert([
            'site_title' => 'Real Estate',
            'site_subtitle' =>'real estate',
           'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
