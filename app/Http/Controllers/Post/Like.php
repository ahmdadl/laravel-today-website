<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostLike;
use Cookie;
use Illuminate\Http\JsonResponse;
use LikeIt;
use Illuminate\Http\Request;
use Response;

class Like extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|JsonResponse
     */
    public function __invoke(Request $request, string $post): Response | JsonResponse
    {
        $res = request()->validate([
            'like' => 'nullable',
        ]);

        $liked = isset($res['like']) ? LikeIt::like($post) : LikeIt::dislike($post);

        if (!$liked) {
            return response()->noContent();
        }

        return response()->json([], 201);
    }
}
