<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetProviders extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(
            Cache::remember(
                'providers',
                now()->addDay(),
                fn() => Provider::withCount('posts')
                    ->whereStatus(Provider::APPROVED)
                    ->get(),
            ),
        );
    }
}
