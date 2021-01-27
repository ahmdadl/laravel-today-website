<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Provider;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;

class Index extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    #[Get('/')]
    public function __invoke(Request $request)
    {
        return view('posts.index', [
            'posts' => Post::with('provider')->latest()->paginate(),
        ]);
    }
}
