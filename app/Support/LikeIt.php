<?php

namespace App\Support;

use App\Models\PostLike;
use Illuminate\Support\Facades\Cookie;
use Crawler;
use DB;
use Illuminate\Http\Request;
use Str;

final class LikeIt
{
    /**
     * PHP stores the DNT header under the "HTTP_DNT" key instead of "DNT".
     *
     * @var string
     */
    const DNT = 'HTTP_DNT';

    /**
     * 5 years in minutes
     */
    const COOKIE_EXPIRE = 2628000;

    protected string $cookieKey = PostLike::COOKIE_KEY;

    public function __construct(
        private Request $request,
    ) {
        
    }

    /**
     * Get the unique ID that represents the visitor.
     */
    public function id(): string
    {
        if (! Cookie::has($this->cookieKey)) {
            $uniqueString = $this->generateUniqueCookieValue();

            // store for 5 years
            Cookie::queue($this->cookieKey, $uniqueString, self::COOKIE_EXPIRE);

            return $uniqueString;
        }

        return Cookie::get($this->cookieKey);
    }
 
    private function generateUniqueCookieValue(): string
    {
        $str = Str::random(80);

        if (PostLike::whereCookie($str)->exists()) {
            return $this->generateUniqueCookieValue();
        }

        return $str;
    }

    /**
     * Get the visitor IP address.
     */
    public function ip(): ?string
    {
        return $this->request->ip();
    }

    /**
     * Determine if the visitor has a "Do Not Track" header.
     */
    public function hasDoNotTrackHeader(): bool
    {
        return 1 === (int) $this->request->header(self::DNT);
    }

    /**
     * Determine if the visitor is a crawler.
     */
    public function isCrawler(): bool
    {
        return Crawler::isCrawler();
    }

    public function like(string $slug, ?string $ip = null): bool
    {
        if ($this->isLiked($slug)) {
            return false;
        }

        return !!DB::table('post_likes')->insert([
            'post_slug' => $slug,
            'cookie' => $this->id(),
            'ip' => $ip ?? request()->ip(),
        ]);
    }

    public function dislike(string $slug, ?string $ip = null): bool
    {
        return !!PostLike::wherePostSlug($slug)
            ->whereCookie($this->id())
            // ->whereIp($ip ?? request()->ip())
            ->limit(1)
            ->delete();
    }

    public function isLiked(string $slug): bool
    {
        return PostLike::wherePostSlug($slug)
        ->whereCookie($this->id())
        ->exists();
    }
}