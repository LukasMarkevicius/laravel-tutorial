<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'description'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
