<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetPopular extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(
        Request $request,
        ?string $slug = null,
        ?bool $is_provider = null
    ): JsonResponse {
        if ($slug !== null) {
            $posts =
                null !== $is_provider
                    ? Post::whereProviderSlug($slug)
                    : Post::whereCategorySlug($slug);
        } else {
            $posts = Post::limit(5);
        }

        return response()->json(
            $posts
                ->withCount('likes')
                ->orderByDesc('likes_count')
                ->limit(5)
                ->get(),
        );
    }
}
