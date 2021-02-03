<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(6)
            ->sequence(
                $this->provUser(
                    'Laravel News',
                    'https://laravel-news.com',
                    'https://laravel-news.com/favicon-32x32.png',
                ),
                $this->provUser(
                    'Scotch io',
                    'https://scotch.io',
                    'https://scotch.io/favicon-32x32.png',
                ),
                $this->provUser(
                    'Envato Tuts+',
                    'https://code.tutsplus.com',
                    'https://static.tutsplus.com/packs/media/images/favicon-4822c2463d591273c6c8eea96b1422e3.png',
                ),
                $this->provUser(
                    'Scott Robinson',
                    'https://dor.ky/',
                    'https://dor.ky/assets/images/favicons/favicon-32x32.png',
                ),
                $this->provUser(
                    'DigitalOcean',
                    'https://www.digitalocean.com',
                    'https://www.digitalocean.com/assets/community/favicon-32x32-e377577c425642ab495296dfec040ec903e36ffc4cd7a0a4281e84597891a774.png'
                ),
                $this->provUser(
                    'Pusher',
                    'https://pusher.com',
                    'https://d2cy1obokpvee9.cloudfront.net/manifest/favicon-96x96.png'
                )
            )
            ->create();

        // User::factory()->create([
        //     'email' => 'admin@site.test',
        // ]);

        User::factory()
            ->count(9)
            ->create();
    }

    private function provUser(
        string $name,
        string $url,
        ?string $image = null
    ): array {
        $name = Str::title($name);
        $slug = Str::slug($name);
        $email = $slug . '@' . $slug . '.com';
        $password = Hash::make(bin2hex(random_bytes(9)));

        return compact('name', 'url', 'image', 'url', 'password', 'email');
    }
}
