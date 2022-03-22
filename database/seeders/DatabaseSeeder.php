<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Request::factory()->count(3)->create();
        \App\Models\Comment::factory()->count(5)->create();
        \App\Models\Like::factory()->count(5)->create();
    }
}
