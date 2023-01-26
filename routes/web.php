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

//概要
Route::get('/info', function () {
    return view('info');
})->name('info');

// 操作方法
Route::get('/operate', function () {
    return view('operate');
})->name('operate');

//記事一覧
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
    //プロフィール
    Route::get('/{name}/edit', 'edit')->name('edit')->middleware('auth');
    Route::patch('/{name}/update', 'update')->name('update')->middleware('auth');
    //パスワード変更
    Route::get('/{name}/password', 'password')->name('password')->middleware('auth');
    Route::patch('/{name}/password', 'passwordUpdate')->name('passwordUpdate')->middleware('auth');
    //マイページのいいねタブ
    Route::get('/{name}/likes', 'likes')->name('likes');
    //フォロー中、フォロワーの一覧
    Route::get('/{name}/followings', 'followings')->name('followings');
    Route::get('/{name}/followers', 'followers')->name('followers');
    //フォロー機能
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'follow')->name('follow');
        Route::delete('/{name}/follow', 'unfollow')->name('unfollow');
    });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
