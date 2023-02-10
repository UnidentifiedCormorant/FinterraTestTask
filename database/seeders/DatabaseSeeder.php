<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Transfer;
use App\Models\User;
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
         User::factory(10)->create();
         Transfer::factory(5)->create();

         User::factory()->create([
             'name' => 'Dungeon master',
             'email' => 'VanDarkholm@gmail.com',
             'password' => '6969'
         ]);
    }
}
