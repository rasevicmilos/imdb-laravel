<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;

class MostPopularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMostPopular()
    {
        $movies = Movie::orderBy('number_of_likes', 'desc')->limit(10)->get();
        return $movies;
    }
}