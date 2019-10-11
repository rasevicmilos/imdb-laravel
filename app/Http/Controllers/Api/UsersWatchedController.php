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
        
        return response()->json($movie);
    }
}
