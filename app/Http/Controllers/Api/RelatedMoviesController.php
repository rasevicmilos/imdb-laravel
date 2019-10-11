<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use Illuminate\Http\Request;

class RelatedMoviesController extends Controller
{
    /**
     * Get related movies
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function getRelatedMovies($id)
    {
        $movie = Movie::findOrFail($id);
        $related_movies = Movie::where('genre_id', '=', "$movie->genre_id")->limit(10)->get();
        return response()->json($related_movies);
    }
}
