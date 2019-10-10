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
    Route::get('like/{id}', 'Api\MoviesLikeController@like');
    Route::get('dislike/{id}', 'Api\MoviesLikeController@dislike');
    Route::get('remove-like/{id}', 'Api\MoviesLikeController@removeLike');
    Route::get('remove-dislike/{id}', 'Api\MoviesLikeController@removeDislike');
    Route::apiResource('genres', 'Api\GenreController');
    Route::apiResource('comments', 'Api\CommentsController');
    Route::get('get-movies', 'Api\UsersWatchlistsController@getMovies');
    Route::get('add-to-watch-list/{id}', 'Api\UsersWatchlistsController@add');
    Route::get('remove-from-watch-list/{id}', 'Api\UsersWatchlistsController@remove');
    Route::get('add-to-watched/{id}', 'Api\UsersWatchedController@markAsWatched');
});