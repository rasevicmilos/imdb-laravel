<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
