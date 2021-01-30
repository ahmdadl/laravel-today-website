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
        if (request('q')) {
            return $this->search(
                $this->getPostBuilder('liked')->orderByDesc('created_at'),
            );
        }

        $news = $this->getPostBuilder()
            ->whereCategorySlug('news')
            ->limit(8)
            ->get();
        $tut = $this->getPostBuilder()
            ->limit(8)
            ->whereCategorySlug('tutorial')
            ->get();

        return view('index', compact('news', 'tut'));
    }

    private function search(Builder $posts): View
    {
        ['q' => $q] = request()->validate([
            'q' => 'required|string|min:3|max:255',
        ]);

        $posts = $posts
            ->where('title', 'LIKE', "%$q%")
            ->orWhere('provider_slug', 'LIKE', '%' . Str::slug($q) . '%')
            ->paginate();

        return view('posts.by_category', compact('posts'));
    }

    private function getPostBuilder(string $orderBy = 'created_at'): Builder
    {
        return Post::with('provider')->orderByDesc($orderBy);
    }
}
