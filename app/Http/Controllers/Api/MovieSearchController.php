<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class MovieSearchController extends Controller
{
    /**
     * Search movies
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $genre = $request->input('genre');
        // return $genre;
        if($genre == 0){
            $searchedMovies = Movie::where('title', 'LIKE', '%' . $query . '%' );
        } else {
            $searchedMovies = Movie::where('genre_id', '=', $genre)->where('title', 'LIKE', '%' . $query . '%' );
        }
        $movies = $searchedMovies->paginate(10);
        $movies->map(function($item) {
            if(auth()->user()->likedMovies->contains($item)){
                $item->user_liked = true; 
            }
            if(auth()->user()->dislikedMovies->contains($item)){
                $item->user_disliked = true; 
            }
            return $item;
        });
        return $movies;
    }
}
