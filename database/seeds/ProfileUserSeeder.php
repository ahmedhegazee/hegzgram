<?php

use Illuminate\Database\Seeder;

class ProfileUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ProfileUser::class,20)->create();
    }
}
