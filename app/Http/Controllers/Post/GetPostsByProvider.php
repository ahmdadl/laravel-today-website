<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Provider;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SEOMeta;

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
        SEOMeta::setTitle($provider->title . ' Provider');

        $owner = Cache::rememberForever(
            $provider->slug . '_owner_' . $provider->user_id,
            fn () => $provider->owner
        );
        return view('posts.by_category', [
            'posts' => Post::whereProviderSlug($provider->slug)
                ->orderByDesc('liked')
                ->orderByDesc('created_at')
                ->paginate(),
            'provider' => $provider,
            'owner' => $owner,
        ]);
    }
}
