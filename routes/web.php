<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', 'ArticleController@index');

use App\Http\Controllers\ArticleController;
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::resource('/articles', ArticleController::class)->except(['index, show'])->middleware('auth');
Route::resource('/articles', ArticleController::class)->only(['show']);

//いいね機能
Route::controller(ArticleController::class)->prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'unlike')->name('unlike')->middleware('auth');
});

//タグ別記事一覧
use App\Http\Controllers\TagController;
Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');

//ユーザーページ
use App\Http\Controllers\UserController;
Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'show')->name('show');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
