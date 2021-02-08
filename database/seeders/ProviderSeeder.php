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

        // $users = User::all();

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

        $this->prov(
            'DigitalOcean',
            'DigitalOcean laravel',
            'https://www.digitalocean.com',
            'https://www.digitalocean.com/community/search?q=laravel&primary_filter=newest&type=tutorials',
            'Technical tutorials, Q&A, events — This is an inclusive place where developers can find or lend support and discover new ways to contribute to the community'
        );

        $this->prov(
            'Pusher',
            'Pusher',
            'https://pusher.com',
            'https://pusher.com/tutorials?tag=Laravel',
            'Pusher tutorials, learn what you can build with Pusher'
        );

        $this->prov(
            'John Koster',
            'Stillat',
            'https://stillat.com',
            'https://stillat.com/category/laravel-5',
            'I have been blogging about software development since 2012, and developing since the early 2000s. Proficiencies include C#, PHP, Laravel, parsers, and data management'
        );

        $this->prov(
            'Povilas Korop',
            'Laravel Daily',
            'https://laraveldaily.com',
            'https://laraveldaily.com',
            'Laravel Tips & Tutorials - Laravel Daily'
        );

        $this->prov(
            'Vegibit',
            'Vegibit',
            'https://vegibit.com',
            'https://vegibit.com/tag/laravel/',
            'laravel & Vegibit'
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
