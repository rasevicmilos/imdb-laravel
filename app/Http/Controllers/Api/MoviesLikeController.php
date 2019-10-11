<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class MoviesLikeController extends Controller
{
    /**
     * Like movies and remove likes
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function like(Request $request)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($request->input('movie_id'));
        if ($request->input('like')) {
            if(auth()->user()->dislikedMovies->contains($movie)){
                auth()->user()->dislikedMovies()->detach($movie);
                $movie->number_of_dislikes--;
            }
            auth()->user()->likedMovies()->save($movie);

            $movie->number_of_likes++;
        } else {
            auth()->user()->likedMovies()->detach($movie);
            $movie->number_of_likes--;
        }
            
        $movie->save();

        return response()->json($movie);
    }

    /**
     * Dislike movies
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dislike(Request $request)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($request->input('movie_id'));
        if ($request->input('dislike')) {
            if(auth()->user()->likedMovies->contains($movie)){
                auth()->user()->likedMovies()->detach($movie);
                $movie->number_of_likes--;
            }
            auth()->user()->dislikedMovies()->save($movie);
            
            $movie->number_of_dislikes++;
        } else {
            auth()->user()->dislikedMovies()->detach($movie);
            $movie->number_of_dislikes--;
        }

        $movie->save();

        return response()->json($movie);
    }
}
