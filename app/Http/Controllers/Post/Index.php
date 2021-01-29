<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Str;

class Index extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $posts = Post::with('provider')
            ->orderByDesc('liked')
            ->orderByDesc('created_at');

        if (request('q')) {
            return $this->search($posts);
        }

        return view('posts.index', [
            'posts' => $posts->paginate(),
        ]);
    }

    public function search(Builder $posts): View
    {
        ['q' => $q] = request()->validate([
            'q' => 'required|string|min:3|max:255',
        ]);

        $posts = $posts
            ->where('title', 'LIKE', "%$q%")
            ->orWhere('provider_slug', 'LIKE', "%". Str::slug($q) ."%")
            ->paginate();

        return view('posts.by_category', compact('posts'));
    }
}
