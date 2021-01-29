<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;
    use sluggable;

    public $timestamps = false;

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
        return is_null($this->image) || empty($this->image)
            ? "https://images.test/users/8.jpg"
            : $this->image;
    }


    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'provider_slug', 'slug');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
