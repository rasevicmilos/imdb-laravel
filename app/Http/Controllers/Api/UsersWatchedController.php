<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class UsersWatchedController extends Controller
{
    /**
     * Add movie to watched movies
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function markAsWatched($movieId)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($movieId);
        auth()->user()->watchedMovies()->save($movie);
        
        $in_watchlist = auth()->user()->moviesInWatchList->contains($movie);

        $user_liked = auth()->user()->likedMovies->contains($movie);
        
        $user_disliked = auth()->user()->dislikedMovies->contains($movie);
        
        $watched = collect(['watched' => true, 'in_watchlist' => $in_watchlist, 'user_liked' => $user_liked, 'user_disliked' => $user_disliked]);

        $data = $watched->merge($movie);

        return response()->json($data);
    }
}
