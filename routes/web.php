<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::post('/subscribe', 'SubsController@subscribe');
Route::get('/verify/{token}', 'SubsController@verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/comment', 'CommentsController@store');
    Route::resource('/my_posts','PostsController');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware' => 'admin'], function(){
    Route::get('/','DashboardController@index');
    Route::resource('/categories','CategoriesController');
    Route::resource('/tags','TagsController');
    Route::resource('/users','UsersController');
    Route::get('/users/toggle/{id}', 'UsersController@toggleStatus');
    Route::get('/users/is_admin/{id}', 'UsersController@toggleAdmin');
    Route::resource('/posts','PostsController');
    Route::get('/posts/toggle/{id}', 'PostsController@toggleStatus');
    Route::get('/posts/is_featured/{id}', 'PostsController@toggleFeatured');
    Route::get('/comments', 'CommentsController@index');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
    Route::resource('/subscribers','SubscribersController');
});

