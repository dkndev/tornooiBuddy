<?php

use Illuminate\Database\Seeder;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tournaments\Tournament::truncate();
        factory(\App\Models\Tournaments\Tournament::class,20)->create()->each(function ($bar){
            $bar->rankings()->sync(
                \App\Models\Tournaments\Ranking::all()->random(rand(1,6))
            );
        });
    }
}
