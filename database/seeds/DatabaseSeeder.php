<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
         $this->call(ProfilesTableSeeder::class);
         $this->call(ResourceTypesTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(PostUserSeeder::class);
         $this->call(ProfileUserSeeder::class);
        Artisan::call('clear:commonids');
        Artisan::call('clear:repeated');
    }
}
