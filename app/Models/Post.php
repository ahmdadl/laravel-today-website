<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LikeIt;

class Post extends Model
{
    use HasFactory;
    use sluggable;

    protected $guarded = [];

    protected $casts = [
        'likes_count' => 'int',
    ];

    protected $appends = ['image_url', 'is_liked'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * get image_url or default image if not present
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return is_null($this->image) || empty($this->image)
            ? 'https://images.test/posts/5.jpg'
            : $this->image;
    }

    /**
     * check if current user liked this post before
     *
     * @return boolean
     */
    public function getIsLikedAttribute(): bool
    {
        return PostLike::wherePostSlug($this->slug)
            ->whereCookie(LikeIt::id())
            ->exists();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_slug', 'slug');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_slug', 'slug')->with(
            'owner',
        );
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class, 'post_slug', 'slug');
    }

    public function like(string $cookie, ?string $ip = null): bool
    {
        return !!$this->likes()->create([
            'post_slug' => $this->slug,
            'cookie' => $cookie,
            'ip' => $ip ?? request()->ip(),
        ]);
    }

    public function dislike(string $cookie, ?string $ip = null): bool
    {
        return !!PostLike::wherePostSlug($this->slug)
            ->whereCookie($cookie)
            // ->whereIp($ip ?? request()->ip())
            ->limit(1)
            ->delete();
    }
}
