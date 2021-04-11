<?php

/*
    I'M USING MANUAL SQL BECAUSE IT'S REQUIRED FOR MY PROJECT
    PLS USE ELOQUENT
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

//Models
use  App\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Personalized Endpoints

    //Routes for getting posts
        Route::GET('/posts', function () {
            return DB::select('SELECT id, content FROM posts');
        });

        Route::GET('/posts/{id}', function ($id) {
            return DB::select('SELECT id, title, content FROM posts WHERE id ='. $id);
        });
    //end GET

    //Route to insert new posts
        Route::POST('/posts', function () {

            //If try to user try to insert just with a column
            //It will redirect to the index
            request()->validate([
                'title' => 'required',
                'content' => 'required',
            ]);

            return Post::create([
                'title' => request('title'),
                'content' => request('content')
            ]);
        });
    //end POST

    //Route to Update a post
        Route::PUT('/posts/{id}', function ($id) {

            request()->validate([
                'title' => 'required',
                'content' => 'required',
            ]);

            $newTitle = Request('title');
            $newContent = Request('content');

            $success = DB::update("UPDATE posts SET title='$newTitle', content='$newContent' WHERE id='$id'");

            return['success' => $success];

        });
    //end PUT

    //Route to Delete Posts
    Route::delete('/posts', function ($id) {

        $delete = DB::delete("DELETE FROM posts WHERE id = '$id'");

    });

//end Endpoints









