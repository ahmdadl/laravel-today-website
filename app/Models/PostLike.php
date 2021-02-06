<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;

    public const COOKIE_LENGTH = 8;
    public const COOKIE_KEY = 'like_post'; 

    public $timestamps = false;

    protected $guarded = ['id'];
}
