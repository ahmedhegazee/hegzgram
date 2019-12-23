<?php

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

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Route::get('/email',function(){
//    return new NewUserWelcomeMail();
//});
//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
//Route::post('/follow/{user}',function (){
//    return ['success'];
//});
Route::post('/follow/{user}','FollowsController@store');
Route::post('/like/{post}','LikesController@storePostLike');
Route::post('/likec/{comment}','LikesController@storeCommentLike');
Route::post('/liker/{reply}','LikesController@storeReplyLike');
//Profile Routes

Route::resource('profile','ProfileController')->only(['show','edit','update','store']);
Route::resource('post','PostsController')->middleware('auth')->except('show');
Route::get('/post/{post}','PostsController@show')->name('post.show');
//Posts Routes
Route::get('/', 'PostsController@index')->name('home')->middleware('auth');
Route::get('/posts','PostsController@posts')->middleware('auth');

Route::get('/followers/{profile}','ProfileController@followers')->name('profile.followers');
Route::get('/followings/{profile}','ProfileController@followings')->name('profile.followings');
Route::get('/friends/{profile}','ProfileController@friends')->name('profile.friends');

Route::any('/search', function () {
    $q = request()->get('q');
    $user = \App\User::where('username', 'LIKE', '%' . $q . '%')->get();
    if (count($user) > 0)
        return redirect()->back()->with('details', $user);
    else return redirect()->back()->with('message', 'No Users found. Try to search again !');
})->name('result');
Route::any('/friend/{user}',function(\App\User $user){
    if(auth()->user()->id !=$user->id)
  return auth()->user()->toggleFriendRequest($user);
});

Route::any('/friend/{user}/accept',function(\App\User $user){
   return auth()->user()->acceptFriendRequest($user);
});
Route::get('/search','UserSearchController@index');

Route::get('/comments/{post}','CommentsController@show');
Route::patch('/comments/{comment}','CommentsController@update');
Route::delete('/comments/{comment}','CommentsController@destroy');
Route::post('/comments/{post}','CommentsController@store');
Route::post('/replies/{comment}','RepliesController@store');
Route::patch('/replies/{reply}','RepliesController@update');
Route::delete('/replies/{reply}','RepliesController@destroy');
