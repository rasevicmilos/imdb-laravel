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
        $searchedMovies = Movie::where('title', 'LIKE', '%' . $query . '%' );
        $movies = $searchedMovies->paginate(10);
        return $movies;
    }
}
