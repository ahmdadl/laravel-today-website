<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    use sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title",
            ],
        ];
    }

    /**
     * get image_url or default image if not present
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        $defaultUri = "https://images.test/posts/5.jpeg";

        return is_null($this->image) || empty($this->image)
            ? $defaultUri
            : $this->image;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_slug", "slug");
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, "provider_slug", "slug");
    }
}
