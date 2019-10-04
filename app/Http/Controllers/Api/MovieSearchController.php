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
        //paginate(10)->
       

        //     if($q != ""){
        //     $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->paginate (5)->setPath ( '' );
        //     $pagination = $user->appends ( array (
        //        'q' => Input::get ( 'q' ) 
        //      ) );
        //     if (count ( $user ) > 0)
        //      return view ( 'welcome' )->withDetails ( $user )->withQuery ( $q );
        //     }
        //      return view ( 'welcome' )->withMessage ( 'No Details found. Try to search again !' );
        //    } );
    }
}
