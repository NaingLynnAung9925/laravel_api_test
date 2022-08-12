<?php

use Illuminate\Support\Facades\Route;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Car;
use App\Models\Owner;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('post', function(){
    return User::find(3)->post;
});

Route::get('comment', function(){
    return Post::find(3)->comments()->where('name', 'bb')->first();
});

Route::get('/comment/post', function(){
    $comment = Comment::find(3);
    return $comment->post->title;
});

Route::get('owner', function(){
    $cars = Car::find(1);
    foreach($cars->owners as $owner){
        return $owner;
    }
});

Route::get('car', function(){
    $car = Car::find(1);
    foreach($car->owners as $owner){
        return $owner->pivot->car_id;
    }
});

Route::get('count', function(){
    $posts = Post::withCount('comments')->get();
    return $posts;
});
