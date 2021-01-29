<?php

use App\Http\Controllers\GetPostByCategory;
use App\Http\Controllers\Post\GetPopular;
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
Route::post('/{post}/like', Like::class);

Route::get('/popular/{slug}/{provider?}', GetPopular::class);

Route::get('/category/{category}', GetPostByCategory::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware([])->name('dashboard');

require __DIR__.'/auth.php';
