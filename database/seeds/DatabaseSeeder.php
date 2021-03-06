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

        $this->call(ContactsTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(RankingsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(PostcodeTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(TournamentsTableSeeder::class);
    }
}
