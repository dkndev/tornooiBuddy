<?php

use Illuminate\Database\Seeder;

class RankingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\Tournaments\Ranking::truncate();
        \App\Models\Tournaments\Ranking::create(['rank' => 'A']);
        \App\Models\Tournaments\Ranking::create(['rank' => 'B1']);
        \App\Models\Tournaments\Ranking::create(['rank' => 'B2']);
        \App\Models\Tournaments\Ranking::create(['rank' => 'C1']);
        \App\Models\Tournaments\Ranking::create(['rank' => 'C2']);
        \App\Models\Tournaments\Ranking::create(['rank' => 'D']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
