<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(\App\Models\Tournaments\Contact::class);
        $this->call(\App\Models\Tournaments\Location::class);
        $this->call(\App\Models\Tournaments\Ranking::class);
    }
}
