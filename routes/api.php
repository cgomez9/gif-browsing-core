<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['json.response']], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Public routes
    Route::post('/login', 'Api\AuthController@login')->name('login.api');
    Route::post('/register', 'Api\AuthController@register')->name('register.api');

    // Private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Api\AuthController@logout')->name('logout.api');
        // Giphy API integration
        Route::get('/gif/search/{query}', 'Api\GiphyApiController@search')->name('search.api');
        Route::get('/gif/{id}', 'Api\GiphyApiController@getGif')->name('get.gif.api');
        Route::get('/gif/multiple/{id}', 'Api\GiphyApiController@getGifs')->name('get.gifs.api');
        Route::get('/gif/trending', 'Api\GiphyApiController@getTrendingGifs')->name('trending.gif.api');
        // User's favorite GIF
        Route::post('/favorite', 'Api\FavoriteGifController@store')->name('favorite.store.api');
        Route::get('/favorite', 'Api\FavoriteGifController@index')->name('favorite.index.api');
        Route::delete('/favorite/{favoriteId}', 'Api\FavoriteGifController@destroy')->name('favorite.destroy.api');
        // User's search history
        Route::post('/history', 'Api\HistoryController@store')->name('history.store.api');
        Route::get('/history', 'Api\HistoryController@index')->name('history.index.api');
    });

});
