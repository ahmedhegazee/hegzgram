<?php

use Illuminate\Database\Seeder;

class ResourceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ResourceType::create(['name'=>'image']);
        \App\ResourceType::create(['name'=>'pdf']);
        \App\ResourceType::create(['name'=>'document']);
        \App\ResourceType::create(['name'=>'sheet']);
        \App\ResourceType::create(['name'=>'presentation']);
        \App\ResourceType::create(['name'=>'audio']);
        \App\ResourceType::create(['name'=>'video']);
    }
}
