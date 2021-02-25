<?php

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

// 認証関連のルーティング
Auth::routes();

// 各種ページのルーティング
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index','show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);

// いいね関連のルーティング
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

// タグ検索のルーティング
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

// ユーザー関連のルーティング
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');

    // いいねタブのルーティング
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');

    // フォローフォロワーリストの取得
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');

    // ログイン済みの場合のみアクセス可能
    Route::middleware('auth')->group(function () {
        // フォロー関連のルーティング
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

