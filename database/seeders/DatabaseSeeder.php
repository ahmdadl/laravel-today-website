<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class DatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../seeds/';
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProviderSeeder::class,
            PostSeeder::class,
        ]);

        // $this->seed('DataTypesTableSeeder');
        // $this->seed('DataRowsTableSeeder');
        // $this->seed('MenusTableSeeder');
        // $this->seed('MenuItemsTableSeeder');
        // $this->seed('RolesTableSeeder');
        // $this->seed('PermissionsTableSeeder');
        // $this->seed('PermissionRoleTableSeeder');
        // $this->seed('SettingsTableSeeder');
    }
}
