<?php

use App\Http\Controllers\Post\GetPostsByCategory;
use App\Http\Controllers\Post\GetPopular;
use App\Http\Controllers\Post\GetPostsByProvider;
use App\Http\Controllers\Post\GetProviders;
use App\Http\Controllers\Post\Index;
use App\Http\Controllers\Post\Like;
use App\Http\Controllers\ProviderController;
use App\Models\Post;
use Database\Seeders\AdminTablesSeeder;
use Encore\Admin\Auth\Database\Menu;
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

Route::prefix('/providers')->group(function () {
    Route::get('', GetProviders::class);

    Route::get('/create', [ProviderController::class, 'create'])->name(
        'add_provider',
    );

    Route::post('', [ProviderController::class, 'store'])->name(
        'post_provider',
    );

    Route::get('/check', [ProviderController::class, 'checkState']);
    Route::post('/check', [ProviderController::class, 'checkState']);

    Route::put('/{id}', [ProviderController::class, 'updateStatus'])
        ->middleware('auth')
        ->whereNumber('id');
});

require __DIR__ . '/auth.php';

// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });

Route::get('/{provider}', GetPostsByProvider::class)->where(
    'provider',
    "^[a-z0-9]+(?:-[a-z0-9]+)*$",
);
