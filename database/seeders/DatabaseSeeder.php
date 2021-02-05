<?php

namespace Database\Seeders;

use DB;
use Encore\Admin\Auth\Database\AdminTablesSeeder as AdminSeeder;
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
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProviderSeeder::class,
            PostSeeder::class,
            AdminTablesSeeder::class,
        ]);
    }
}
