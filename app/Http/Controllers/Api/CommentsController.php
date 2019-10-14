<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Comment;
use App\Movie;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::where('movie_id', '=', $request->input('movie'))->paginate(5);

        // $comments = Comment::where('movie_id', '=', $request->input('movie'))->orderBy('created_at', 'desc')->paginate(10);
        return $comments;
    }

     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLastPage(Request $request)
    {
        $comments = Comment::where('movie_id', '=', $request->input('movie'))->paginate(5);

        return $comments->lastPage();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->name,
            'movie_id' => $request->input('movie_id'),
            'text' => $request->input('text'),
        ]);
        
       
        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
