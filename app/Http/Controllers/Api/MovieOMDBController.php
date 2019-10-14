<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Movie;
use App\Genre;
use Illuminate\Http\Request;

class MovieOMDBController extends Controller
{
    /**
     * Add a movie from OMDB
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $genres = explode(",", $request->input('genre'));
        $genre_string = $genres[0];
        $genre = Genre::where('name','LIKE',"$genre_string")->first();

        $movie = Movie::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'genre_id' => $genre->id,
            'number_of_likes' => 0,
            'number_of_dislikes' => 0,
            'image_url' => $request->input('image_url')
        ]);

        $movie->genre = $genre;
        return $movie;
    }
}
