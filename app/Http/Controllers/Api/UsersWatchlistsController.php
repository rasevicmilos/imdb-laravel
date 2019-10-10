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
        if(auth()->user()->likedMovies->contains($movie)){
            $movie->user_liked = true; 
        }
        if(auth()->user()->dislikedMovies->contains($movie)){
            $movie->user_disliked = true; 
        }
        if(auth()->user()->watchedMovies->contains($movie)) {
            $movie->watched = true;
        }
        $movie->in_watchlist = true;
        return response()->json($movie);
    }

    /**
     * Get watchlist
     * @return \Illuminate\Http\Response
     */
    public function getMovies()
    {
        $movies = auth()->user()->moviesInWatchlist()->with('genre')->get();
        $movies->map(function($item) {
            if(auth()->user()->likedMovies->contains($item)){
                $item->user_liked = true; 
            }
            if(auth()->user()->dislikedMovies->contains($item)){
                $item->user_disliked = true; 
            }
            if(auth()->user()->watchedMovies->contains($item)) {
                $item->watched = true;
            }
            $item->in_watchlist = true;
            return $item;
        });
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
        if(auth()->user()->likedMovies->contains($movie)){
            $movie->user_liked = true; 
        }
        if(auth()->user()->dislikedMovies->contains($movie)){
            $movie->user_disliked = true; 
        }
        if(auth()->user()->watchedMovies->contains($movie)) {
            $movie->watched = true;
        }
        $movie->in_watchlist = false;
        return response()->json($movie);
    }
}
