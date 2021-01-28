<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class Like extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        $res = request()->validate([
            'like' => 'nullable',
        ]);

        $liked = isset($res['like']) ? $post->like() : $post->dislike();

        if ($liked !== 1) {
            return response()->noContent();
        }

        return response()->json([], 201);
    }
}
