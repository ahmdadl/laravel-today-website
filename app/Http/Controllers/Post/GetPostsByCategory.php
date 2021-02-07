<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class GetPostsByCategory extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View|Illuminate\Contracts\View\Factory
     */
    public function __invoke(Request $request, Category $category): Factory | View
    {
        SEOMeta::setTitle($category->title . ' Posts');

        return view('posts.by_category', [
            'posts' => Post::with('provider')
                ->withCount('likes')
                ->whereCategorySlug($category->slug)
                ->orderByDesc('likes_count')
                ->orderByDesc('created_at')
                ->paginate(),
        ]);
    }
}
