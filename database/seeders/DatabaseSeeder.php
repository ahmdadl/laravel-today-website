<?php

namespace Database\Seeders;

use Artisan;
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

        Artisan::call('admin:import backup');
        Artisan::call('admin:import helpers');
        Artisan::call('admin:import log-viewer');
        Artisan::call('admin:import scheduling');
    }
}
