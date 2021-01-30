<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetProviders extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json(
            Cache::remember(
                'providers',
                now()->addDay(),
                fn() => Provider::withCount('posts')->get(),
            ),
        );
    }
}
