<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\Tournaments\Location::truncate();
        factory(\App\Models\Tournaments\Location::class, 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}