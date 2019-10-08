<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Genre;

use App\Http\Requests\CreateMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(10);        
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMovieRequest $request)
    {
        $data = $request->validated();

        $movie = Movie::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'genre_id' => $data['genre_id'],
            'number_of_likes' => 0,
            'number_of_dislikes' => 0,
            'image_url' => array_get($data, 'image_url', 'https://icon-library.net/images/no-image-available-icon/no-image-available-icon-6.jpg')
        ]);

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($movieId)
    {
        $movie = Movie::with('genre')->findOrFail($movieId);
        $movie->number_of_views++;
        $movie->save();
        $user_liked = false; 
        //check if user liked
        if(auth()->user()->likedMovies->contains($movie)){
            $user_liked = true;
        }
        //check if user disliked
        $user_disliked = false;
        if(auth()->user()->dislikedMovies->contains($movie)){
            $user_disliked = true;
        }
        
        $liked = collect(['user_liked' => $user_liked, 'user_disliked'=>$user_disliked]);

        $data = $liked->merge($movie);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
