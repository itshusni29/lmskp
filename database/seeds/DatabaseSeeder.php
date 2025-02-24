<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserSeeder2;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan kedua seeder
        $this->call([
            UserSeeder::class,
            UserSeeder2::class,
        ]);
    }
}
