<?php

use App\Http\Controllers\GetPostsByCategory;
use App\Http\Controllers\Post\GetPopular;
use App\Http\Controllers\Post\GetPostsByProvider;
use App\Http\Controllers\Post\GetProviders;
use App\Http\Controllers\Post\Index;
use App\Http\Controllers\Post\Like;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Index::class)->name('home');
Route::post('/{post}/like', Like::class)->where(
    'post',
    "^[a-z0-9]+(?:-[a-z0-9]+)*$",
);

Route::get('/popular/{slug?}/{provider?}', GetPopular::class)
    ->where('slug', "^[a-z0-9]+(?:-[a-z0-9]+)*$")
    ->whereAlpha('provider');

Route::get('/category/{category}', GetPostsByCategory::class)->where(
    'category',
    "^[a-z0-9]+(?:-[a-z0-9]+)*$",
);

Route::get('/providers', GetProviders::class);

require __DIR__ . '/auth.php';

Route::get('/{provider}', GetPostsByProvider::class)->where(
    'provider',
    "^[a-z0-9]+(?:-[a-z0-9]+)*$",
);