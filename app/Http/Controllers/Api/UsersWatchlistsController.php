<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class UsersWatchlistsController extends Controller
{
     /**
     * Add movies to watchlist
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($id);
        auth()->user()->moviesInWatchlist()->save($movie);
        return response()->json($movie);
    }

    /**
     * Get watchlist
     * @return \Illuminate\Http\Response
     */
    public function getMovies()
    {
        $movies = auth()->user()->moviesInWatchlist()->with('genre')->get();
        return response()->json($movies);
    }


    /**
     * Remove movies from watchlist
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($id);
        auth()->user()->moviesInWatchlist()->detach($movie);
        return response()->json($movie);
    }
}
