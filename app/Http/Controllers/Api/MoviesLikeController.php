<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class MoviesLikeController extends Controller
{
     /**
     * Search movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        if(auth()->user()->dislikedMovies->contains($movie)){
            auth()->user()->dislikedMovies()->detach($movie);
            $movie->number_of_dislikes--;
        }
        auth()->user()->likedMovies()->save($movie);

        $movie->number_of_likes++;
        $movie->save();

        $liked = collect(['user_liked' => true]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }

    /**
     * Search movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function dislike($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        if(auth()->user()->likedMovies->contains($movie)){
            auth()->user()->likedMovies()->detach($movie);
            $movie->number_of_likes--;
        }
        auth()->user()->dislikedMovies()->save($movie);
        
        $movie->number_of_dislikes++;
        $movie->save();

        $disliked = collect(['user_disliked' => true]);

        $data = $disliked->merge($movie);

        return response()->json($data);
    }

      /**
     * Search movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function removeLike($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        auth()->user()->likedMovies()->detach($movie);
        $movie->number_of_likes--;
        $movie->save();

        $liked = collect(['user_liked' => false]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }

      /**
     * Search movies
     * @param  int id;
     * @return \Illuminate\Http\Response
     */
    public function removeDislike($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        auth()->user()->dislikedMovies()->detach($movie);
        $movie->number_of_dislikes--;
        $movie->save();

        $liked = collect(['user_disliked' => false]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }


}
