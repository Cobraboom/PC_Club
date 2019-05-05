<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         factory(\App\Models\User::class, 10)->create();

         $this->call(PC_ClubPCSeeder::class);
         factory(\App\Models\PC_ClubSes::class, 10)->create();
    }
}
