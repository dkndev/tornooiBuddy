<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \App\Models\Tournaments\Contact::truncate();
        factory(\App\Models\Tournaments\Contact::class,5)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
