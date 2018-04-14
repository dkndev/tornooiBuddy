<?php

use Illuminate\Database\Seeder;

class PostcodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $path = 'sql/maps_locaties.sql';
        DB::unprepared(file_get_contents($path));
    }
}
