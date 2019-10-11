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

        $q = Movie::with('genre')->where('title', 'LIKE', "%$query%");
        if ($genre != 0) {
            $q->where('genre_id', '=', $genre);
        }

        $movies = $q->paginate(10);
        return $movies;
    }
}
