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

Route::controller(ArticleController::class)->prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'unlike')->name('unlike')->middleware('auth');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
