<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'description'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
