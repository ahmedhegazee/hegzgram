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
Route::post('/like/{post}','LikesController@store');
Route::post('/like/{post}/count','LikesController@count');
Route::post('/likec/{comment}','LikesCommentController@store');
//Profile Routes
//Route::get('/profile/create','ProfileController@create')->name('profile.create');
Route::get('/profile/{profile}','ProfileController@show')->name('profile.show');
Route::get('/profile/{profile}/edit','ProfileController@edit')->name('profile.edit');
Route::post('/profile','ProfileController@store')->name('profile.store');
Route::patch('/profile/{profile}','ProfileController@update')->name('profile.update');

//Posts Routes
Route::get('/', 'PostsController@index')->name('home');
Route::get('/post/create','PostsController@create')->name('post.create');
Route::get('/post/{post}','PostsController@show')->name('post.show');
Route::post('/post','PostsController@store')->name('post.store');

Route::get('/profile/{profile}/followers','ProfileController@followers')->name('profile.followers');
Route::get('/profile/{profile}/followings','ProfileController@followings')->name('profile.followings');

Route::get('/comment/{post}/create','CommentsController@create')->name('comment.create');
Route::post('/comment/{post}','CommentsController@store')->name('comment.store');
