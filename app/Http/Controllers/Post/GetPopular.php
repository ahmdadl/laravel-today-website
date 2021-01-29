<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class GetPopular extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        Request $request,
        string $slug,
        ?bool $is_provider = null
    ) {
        if ($is_provider !== null) {
            $posts = Post::whereProviderSlug($slug);
        } else {
            $posts = Post::whereCategorySlug($slug);
        }

        return response()->json(
            $posts
                ->orderByDesc('liked')
                ->limit(5)
                ->get(),
        );
    }
}
