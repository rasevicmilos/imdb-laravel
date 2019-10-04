<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'description', 'image_url', 'genre_id'];

    // public function genre()
    // {
    //     return $this->hasOne(Genre::class);
    // }
    public function genre() 
    {
        return $this->belongsTo(Genre::class);
    }
}
