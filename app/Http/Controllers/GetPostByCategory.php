<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class GetPostByCategory extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Category $category)
    {
        SEOMeta::setTitle($category->title . ' Posts');

        return view('posts.by_category', [
            'posts' => Post::whereCategorySlug($category->slug)
                ->orderByDesc('liked')
                ->orderByDesc('created_at')
                ->paginate(),
        ]);
    }
}
