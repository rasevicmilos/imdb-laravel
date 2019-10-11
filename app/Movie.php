<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'description', 'image_url', 'genre_id', 'number_of_likes', 'number_of_dislikes'];

    protected $appends = ['watched', 'user_liked', 'user_disliked', 'in_watchlist'];

    // public function genre()
    // {
    //     return $this->hasOne(Genre::class);
    // }
    public function genre() 
    {
        return $this->belongsTo(Genre::class);
    }

    public function usersThatLiked()
    {
        return $this->belongsToMany(User::class, 'user_liked');
    }

    public function usersThatDisliked()
    {
        return $this->belongsToMany(User::class, 'user_disliked');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function usersThatAddedToWatchlist()
    {
        return $this->belongsToMany(User::class, 'user_watchlist');
    }

    public function usersThatWatched()
    {
        return $this->belongsToMany(User::class, 'user_watched');
    }

    public function getWatchedAttribute()
    {
        return auth()->user()->watchedMovies()->where('movie_id', $this->id)->exists();
    }
    
    public function getUserLikedAttribute()
    {
        return auth()->user()->likedMovies()->where('movie_id', $this->id)->exists();
    }

    public function getUserDislikedAttribute()
    {
        return auth()->user()->dislikedMovies()->where('movie_id', $this->id)->exists();
    }

    public function getInWatchListAttribute() 
    {
        return auth()->user()->moviesInWatchList()->where('movie_id', $this->id)->exists();
    }
}
