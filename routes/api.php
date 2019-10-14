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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::group([
    'middleware' => ['jwt.verify']
], function() {
    Route::apiResource('movies', 'Api\MovieController');
    Route::get('search', 'Api\MovieSearchController@search');
    Route::put('like', 'Api\MoviesLikeController@like');
    Route::put('dislike', 'Api\MoviesLikeController@dislike');
    Route::apiResource('genres', 'Api\GenreController');
    Route::get('comments-last-page', 'Api\CommentsController@getLastPage');
    Route::apiResource('comments', 'Api\CommentsController');
    Route::get('get-movies', 'Api\UsersWatchlistsController@getMovies');
    Route::get('add-to-watch-list/{id}', 'Api\UsersWatchlistsController@add');
    Route::delete('remove-from-watch-list/{id}', 'Api\UsersWatchlistsController@remove');
    Route::put('add-to-watched/{id}', 'Api\UsersWatchedController@markAsWatched');
    Route::get('most-popular', 'Api\MostPopularController@getMostPopular');
    Route::get('related-movies/{id}', 'Api\RelatedMoviesController@getRelatedMovies');
    Route::post('add-movie-from-omdb', 'Api\MovieOMDBController@add');
});