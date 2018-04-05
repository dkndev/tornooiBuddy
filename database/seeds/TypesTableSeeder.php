<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\Tournaments\Type::truncate();
        \App\Models\Tournaments\Type::create(['type' => 'I']);
        \App\Models\Tournaments\Type::create(['type' => 'N']);
        \App\Models\Tournaments\Type::create(['type' => 'P']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
