<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class MoviesLikeController extends Controller
{
     /**
     * Like movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($id);
        if(auth()->user()->dislikedMovies->contains($movie)){
            auth()->user()->dislikedMovies()->detach($movie);
            $movie->number_of_dislikes--;
        }
        auth()->user()->likedMovies()->save($movie);

        $movie->number_of_likes++;
        $movie->save();

        $watched = auth()->user()->watchedMovies->contains($movie);
        
        $in_watchlist = auth()->user()->moviesInWatchList->contains($movie);

        $liked = collect(['user_liked' => true, 'watched' => $watched, 'in_watchlist' => $in_watchlist]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }

    /**
     * Dislike movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function dislike($id)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($id);
        if(auth()->user()->likedMovies->contains($movie)){
            auth()->user()->likedMovies()->detach($movie);
            $movie->number_of_likes--;
        }
        auth()->user()->dislikedMovies()->save($movie);
        
        $movie->number_of_dislikes++;
        $movie->save();

        $watched = auth()->user()->watchedMovies->contains($movie);

        $in_watchlist = auth()->user()->moviesInWatchList->contains($movie);

        $disliked = collect(['user_disliked' => true, 'watched' => $watched, 'in_watchlist' => $in_watchlist]);

        $data = $disliked->merge($movie);

        return response()->json($data);
    }

      /**
     * Remove likes from movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function removeLike($id)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($id);
        auth()->user()->likedMovies()->detach($movie);
        $movie->number_of_likes--;
        $movie->save();

        $watched = auth()->user()->watchedMovies->contains($movie);

        $in_watchlist = auth()->user()->moviesInWatchList->contains($movie);

        $liked = collect(['user_liked' => false, 'watched' => $watched, 'in_watchlist' => $in_watchlist]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }

      /**
     * Remove dislikes from movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function removeDislike($id)
    {
        $movie = Movie::with('genre')->with('comments')->findOrFail($id);
        auth()->user()->dislikedMovies()->detach($movie);
        $movie->number_of_dislikes--;
        $movie->save();

        $watched = auth()->user()->watchedMovies->contains($movie);

        $in_watchlist = auth()->user()->moviesInWatchList->contains($movie);

        $liked = collect(['user_disliked' => false, 'watched' => $watched, 'in_watchlist' => $in_watchlist]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }
}
