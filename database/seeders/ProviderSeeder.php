<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $users = User::all();

        Provider::create([
            'user_id' => $users->first()->id,
            'title' => 'Laravel News',
            'url' => 'https://laravel-news.com/',
            'request_url' => 'https://laravel-news.com/category/news',
            'bio' => '© 2012 - 2021 LARAVEL NEWS — BY ERIC L.BARNES - A DIVISION OF DOTDEV INC',
            'status' => Provider::APPROVED,
        ]);

        Provider::factory()
            ->count(5)
            ->state(
                fn() => [
                    'user_id' => $users->random()->id,
                    'status' => Provider::APPROVED,
                ],
            )
            ->create();

        DB::commit();
    }
}
