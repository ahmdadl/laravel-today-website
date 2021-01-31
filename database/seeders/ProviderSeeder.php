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

        Provider::factory()
            ->count(5)
            ->state(fn () => [
                "user_id" => $users->random()->id,
                'status' => Provider::APPROVED, 
            ])
            ->create();
        
        DB::commit();
    }
}
