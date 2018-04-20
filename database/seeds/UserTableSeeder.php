<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'nelis de kerpel',
            'email' => 'nelisdekerpel@hotmail.com',
            'password' => bcrypt('test'),
            'age' => 23,
            'gender' => 'M',
            'postcode_id' => 1125,
            'rank_single' => 2,
            'rank_dubbles' => 2,
            'rank_mix' => 3,
            'complete' => 0,
        ]);
    }
}
