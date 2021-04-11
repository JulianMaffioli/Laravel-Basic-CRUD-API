<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\PostsApiController;

class Post extends Model
{
    //
    protected $fillable = ['title','content'];
}
