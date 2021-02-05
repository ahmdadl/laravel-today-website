<?php

namespace Database\Seeders;

use Encore\Admin\Auth\Database\Menu;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Menu::insert([
            'parent_id' => 0,
            'order' => 9,
            'title' => 'Providers',
            'icon' => 'fa-rocket',
            'uri' => '/providers',
        ]);
        Menu::insert([
            'parent_id' => 0,
            'order' => 8,
            'title' => 'Users',
            'icon' => 'fa-user',
            'uri' => '/users',
        ]);

        // \Encore\Admin\Auth\Database\Permission::insert([]);

        // \Encore\Admin\Auth\Database\Role::insert([]);

        // pivot tables
        // DB::table('admin_role_menu')->insert([]);

        // DB::table('admin_role_permissions')->insert([]);
    }
}
