<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Cache;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Str;

class Index extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Factory|ViewView
     */
    public function __invoke(): Factory | ViewView
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

        $q = strtolower($q);

        $posts = $posts
            ->whereRaw('LOWER(title) LIKE ?')
            ->addBinding("%$q%")
            ->orWhere('provider_slug', 'LIKE', '%' . Str::slug($q) . '%')
            ->paginate();

        return view('posts.by_category', compact('posts'));
    }

    private function getPostBuilder(string $orderBy = 'created_at'): Builder
    {
        return Post::with('provider')
            ->withCount('likes')
            ->orderByDesc($orderBy);
    }
}
