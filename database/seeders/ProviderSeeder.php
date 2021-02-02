<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Str;

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

        $this->prov(
            'Laravel News',
            'Laravel News',
            'https://laravel-news.com',
            'https://laravel-news.com/category/news',
            'Your official news source for the Laravel PHP Framework',
        );
        $this->prov(
            'Laravel News',
            'Laravel News Tutorials',
            'https://laravel-news.com',
            'https://laravel-news.com/category/laravel-tutorials',
            'Interested in learning more about Laravel? This section features tutorials on everything',
        );
        $this->prov(
            'Envato Tuts+',
            'Envato Tuts Laravel',
            'https://code.tutsplus.com/',
            'https://code.tutsplus.com/categories/laravel',
            'Laravel Code Tutorials by Envato Tuts+',
        );

        $this->prov(
            'Scott Robinson',
            'Dor-Ky',
            'https://dor.ky',
            'https://dor.ky/tagged/laravel/',
            'I`m a software developer located in Staffordshire, United Kingdom specialising in PHP, Laravel and APIs. I love  sharing the things I learn'
        );

        // Provider::factory()
        //     ->count(5)
        //     ->state(
        //         fn() => [
        //             'user_id' => $users->random()->id,
        //             'status' => Provider::APPROVED,
        //         ],
        //     )
        //     ->create();

        DB::commit();
    }


    private function prov(
        string $userName,
        string $title,
        string $url,
        string $request_url,
        string $bio = '',
        int $status = Provider::APPROVED
    ): Provider {
        $slug = Str::slug($userName);
        $email = $slug . '@' . $slug . '.com';
        $user_id = User::whereEmail($email)->first()->id;
        return Provider::create(
            compact('user_id', 'title', 'url', 'request_url', 'bio', 'status'),
        );
    }
}
