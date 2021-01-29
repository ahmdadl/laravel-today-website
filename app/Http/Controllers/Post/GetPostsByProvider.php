<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Provider;
use Illuminate\Http\Request;

class GetPostsByProvider extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Provider $provider)
    {
        return view('posts.by_category', [
            'posts' => Post::whereProviderSlug($provider->slug)
                ->orderByDesc('liked')
                ->orderByDesc('created_at')
                ->paginate(),
        ]);
    }
}
