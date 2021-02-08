<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Provider;
use App\Models\User;
use DB;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $users = User::count();
        $posts = Post::count();
        $providers = Provider::count();

        $postsChart = Post::selectRaw('count(id)')
            ->selectRaw('created_at')
            ->groupBy('created_at')
            ->orderBy('created_at')
            ->limit(500)
            ->get('');

        $postsLikes = Post::withCount('likes')
            ->limit(60)
            ->inRandomOrder()
            ->get(['title', 'likes_count']);

        $providersPosts = Provider::select('slug')
            ->withCount('posts')
            ->groupBy('slug')
            ->get('');

        $providersPopular = Post::withCount('likes')
            ->groupBy('posts.provider_slug', 'posts.id')
            ->get(['title', 'likes_count', 'provider_slug'])
            ->groupBy('provider_slug');

        $providersPopular = collect($providersPopular)->map(
            fn(Collection $p): ?int => $p->sum('likes_count'),
        );

        $popularPosts = Post::withCount('likes')->limit(15)->get();

        return $content
            ->title('Dashboard')
            ->view(
                'admin.index',
                compact(
                    'users',
                    'posts',
                    'providers',
                    'postsChart',
                    'postsLikes',
                    'providersPosts',
                    'providersPopular',
                    'popularPosts',
                ),
            );
    }
}
